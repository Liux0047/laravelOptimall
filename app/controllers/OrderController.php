<?php

/**
 * Description of OrderController
 *
 * @author Allen
 */
class OrderController extends BaseController
{

    public function postSubmitOrder()
    {

        $validator = $this->validateAddress();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        //redirect to home page if no items pending
        $items = OrderLineItem::cartItems(Auth::id())->get();
        if (count($items) == 0) {
            return Redirect::to('/');
        }

        $alipayController = new AlipayController();

        $cartController = new ShoppingCartController();
        //必填
        $price = $cartController->getNetPrice();

        //clear the coupon and record the usage
        $couponController = new CouponController();
        $couponId = $couponController->recordCouponUsage();

        $address = new Address;
        $address->recipient_name = Input::get('recipient_name', '');
        $address->receive_address = Input::get('receive_address', '');
        $address->receive_zip = Input::get('receive_zip', '');
        $address->receive_phone = Input::get('receive_phone', '');

        //get the payment service
        $paymentService = Input::get('payment_service');
        //get the bank code
        $bankCode = Input::get('default_bank', '');

        $order = $this->insertOrder($items, $paymentService, $price, $address, $couponId);

        if (!isset($order->order_id)) {
            die("Order not created");
        }
        $tradeNumber = generateTradeNumber($order->order_id);

        $itemNames = Input::get('item_names');

        //send email
        $params['orderNumber'] = $tradeNumber;
        $params['created_at'] = formatDateTime($order->created_at);
        $params['recipient_name'] = $order->recipient_name;
        $params['receive_address'] = $order->receive_address;
        $params['receive_phone'] = $order->receive_phone;
        $params['net_amount'] = $cartController->getNetPrice();
        $params['discount_amount'] = $cartController->getTotalDiscount();

        if (!empty(Auth::user()->email)) {
            Mail::queue('emails.order.confirm-order', $params, function ($message) {
                $message->to(Auth::user()->email)->subject('订单提交成功');
            });
        }

        return $alipayController->generateAlipayPage($tradeNumber, $price, $address, $paymentService, $bankCode, $itemNames);
    }

    public function postReSubmitPayment()
    {
        if (!Input::has('order_id')) {
            return Redirect::back();
        }
        $alipayController = new AlipayController();

        $orderId = Input::get('order_id');
        $order = PlacedOrder::findOrFail($orderId);
        if ($order->member_id != Auth::id()) {
            return Redirect::back()->with('error', '订单号有误');
        }
        $price = $order->total_transaction_amount;
        $tradeNumber = generateTradeNumber($orderId);
        $address = new Address;
        $address->recipient_name = $order->recipient_name;
        $address->receive_zip = $order->receive_zip;
        $address->receive_phone = $order->receive_phone;
        $address->receive_address = $order->receive_address;

        //get the payment service
        $paymentService = Input::get('payment_service');

        return $alipayController->generateAlipayPage($tradeNumber, $price, $address, $paymentService);
    }

    public function getAlipayReturn()
    {
        $AlipayController = new AlipayController();
        $verify_result = $AlipayController->verifyReturn();
        if ($verify_result) {    //verify success
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户订单号
            $out_trade_no = Input::get('out_trade_no');

            $params['isPaymentSuccessful'] = true;
            $params['totalAmount'] = Input::get('total_fee');
            $params['orderId'] = $out_trade_no;
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            $params['isPaymentSuccessful'] = false;
        }
        return View::make('pages.alipay-result', $params);
    }


    public function postAlipayPartnerTradeNotify()
    {
        //计算得出通知验证结果
        $AlipayController = new AlipayController();
        $verify_result = $AlipayController->verifyNotify();

        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            //商户订单号
            $out_trade_no = Input::get('out_trade_no');

            //支付宝交易号
            $trade_no = Input::get('trade_no');

            //交易状态
            $trade_status = Input::get('trade_status');

            return $this->processPartnerTradeUpdate($trade_status, $out_trade_no, $trade_no);

        } else {
            //验证失败
            return "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }


    public function postAlipayDirectPayNotify()
    {
        //计算得出通知验证结果
        $AlipayController = new AlipayController();
        $verify_result = $AlipayController->verifyNotify();

        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            //商户订单号
            $out_trade_no = Input::get('out_trade_no');

            //支付宝交易号
            $trade_no = Input::get('trade_no');

            //交易状态
            $trade_status = Input::get('trade_status');

            return $this->processDirectPayUpdate($trade_status, $out_trade_no, $trade_no);

        } else {
            //验证失败
            return "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    private function processPartnerTradeUpdate($trade_status, $out_trade_no, $trade_no)
    {
        if ($trade_status == 'WAIT_BUYER_PAY') {
            //该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序

            return "success";  //请不要修改或删除
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        } else if ($trade_status == 'WAIT_SELLER_SEND_GOODS') {
            //该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
            $this->recordPayment($out_trade_no, $trade_no);

            return "success";  //请不要修改或删除
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        } else if ($trade_status == 'WAIT_BUYER_CONFIRM_GOODS') {
            //该判断表示卖家已经发了货，但买家还没有做确认收货的操作
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序

            return "success";  //请不要修改或删除
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        } else if ($trade_status == 'TRADE_FINISHED') {
            //该判断表示买家已经确认收货，这笔交易完成
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序

            return "success";  //请不要修改或删除
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        } else {
            //其他状态判断
            return "success";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }

    }

    private function processDirectPayUpdate($trade_status, $out_trade_no, $trade_no)
    {
        if ($trade_status == 'TRADE_FINISHED') {
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序

            //注意：
            //该种交易状态只在两种情况下出现
            //1、开通了普通即时到账，买家付款成功后。
            //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        } else if ($trade_status == 'TRADE_SUCCESS') {
            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
            $this->recordPayment($out_trade_no, $trade_no);

            //注意：
            //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }

        echo "success";        //请不要修改或删除

    }

    public function insertOrder($items, $paymentMethod, $amount, $address, $couponId)
    {
        $order = new PlacedOrder;
        $order->member_id = Auth::id();
        $order->coupon_id = $couponId;
        $order->payment_method = $paymentMethod;
        $order->total_transaction_amount = $amount;
        $order->currency_code = 'RMB';
        $order->order_status_id = 1;
        $order->recipient_name = $address->recipient_name;
        $order->receive_address = $address->receive_address;
        $order->receive_zip = $address->receive_zip;
        $order->receive_phone = $address->receive_phone;

        $order->invoice_header = Input::get('invoice_header');
        $order->message_to_seller = Input::get('message_to_seller');

        // take note of the coupon used, if any
        if (isset($couponId)) {
            $order->coupon_id = $couponId;
        }
        // check if this is the first purchase
        if (Auth::user()->placedOrders()->count() == 0) {
            $order->is_first_purchase = true;
        }

        $order->save();

        foreach ($items as $item) {
            $item->order_id = $order->order_id;
            $item->save();
            $model = $item->product->productModel;
            $model->num_items_sold_display += rand(1, 5);
            $model->save();
        }
        return $order;
    }

    private function recordPayment($out_trade_no, $trade_no)
    {
        //take the 3rd number onwards as order ID
        $order = PlacedOrder::find(intval(substr($out_trade_no, Config::get('optimall.orderNumberPrefixLength'))));
        if (!isset($order->payment_ref_no) && $order->order_status_id == 1) {
            $order->payment_ref_no = $trade_no;
            $order->payment_amount = Input::get('total_fee');
            $order->payment_time = (new DateTime())->format('Y-m-d H:i:s');
            $order->order_status_id = 2;
            if (Input::has('receive_name')) {
                $order->recipient_name = Input::get('receive_name');
            }
            if (Input::has('receive_address')) {
                $order->receive_address = Input::get('receive_address');
            }
            if (Input::has('receive_zip')) {
                $order->receive_zip = Input::get('receive_zip');
            }
            if (Input::has('receive_phone')) {
                $order->receive_phone = Input::get('receive_phone');
            }
            if (Input::has('receive_mobile')) {
                $order->receive_phone = Input::get('receive_mobile');
            }
            $order->save();
            return true;
        } else {
            return false;
        }
    }

    private function validateAddress()
    {
        $rules = array(
            'recipient_name' => 'max:45',
            'receive_address' => 'min:5|max:120',
            'receive_zip' => 'digits_between:5,6',
            'receive_phone' => 'min:8|max:20',
            'invoice_header' => 'max:45',
            'message_to_seller' => 'max:45'
        );
        return Validator::make(Input::all(), $rules);
    }


}

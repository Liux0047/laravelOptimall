<?php

/**
 * Description of OrderController
 *
 * @author Allen
 */
class OrderController extends BaseController {

    public function postSubmitOrder() {
        
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

        $orderController = new OrderController();
        $order = $orderController->insertOrder($items, "Alipay", $price, $address, $couponId);

        if (!isset($order->order_id)) {
            die("Order not created");
        }
        $tradeNumber = $alipayController->generateTradeNumber($order->order_id);

        //send email
        $params['orderNumber'] = $tradeNumber;
        $params['created_at'] = (new DateTime($order->created_at))->format('Y-m-d H:i:s');
        $params['recipient_name'] = $order->recipient_name;
        $params['receive_address'] = $order->receive_address;
        $params['receive_phone'] = $order->receive_phone;
        $params['net_amount'] = $cartController->getNetPrice();
        $params['discount_amount'] = $cartController->getTotalDiscount();
        Mail::queue('emails.order.confirm-order', $params, function($message) {
            $message->to(Auth::user()->email)->subject('订单提交成功');
        });

        return $alipayController->generateAlipayPage($tradeNumber, $price, $address);
    }

    public function postReSubmitPayment() {
        if (!Input::has('order_id')) {
            return Redirect::back();
        }
        $alipayController = new AlipayController();

        $orderId = Input::get('order_id');
        $order = PlacedOrder::findOrFail($orderId);
        if ($order->member_id != Auth::id()) {
            return Redirect::back()->with('error','订单号有误');
        }
        $price = $order->total_transaction_amount;
        $tradeNumber = $alipayController->generateTradeNumber($orderId);
        $address = new Address;
        $address->recipient_name = $order->recipient_name;
        $address->receive_zip = $order->receive_zip;
        $address->receive_phone = $order->receive_phone;
        $address->receive_address = $order->receive_address;


        return $alipayController->generateAlipayPage($tradeNumber, $price, $address);
    }

    public function getAlipayReturn() {
        $AlipayController = new AlipayController();
        $verify_result = $AlipayController->verifyReturn();
        if ($verify_result) {    //verify success
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户订单号
            $out_trade_no = Input::get('out_trade_no');
            //支付宝交易号
            $trade_no = Input::get('trade_no');
            //交易状态
            $trade_status = Input::get('trade_status');

            if ($trade_status == 'WAIT_SELLER_SEND_GOODS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                $this->recordPayment($out_trade_no, $trade_no);
            }
            $params['verifyResult'] = "Verify success";
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            $params['verifyResult'] = "Verify fails";
        }
        return View::make('pages.alipay-result', $params);
    }

    public function insertOrder($items, $paymentMethod, $amount, $address, $couponId) {
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

    private function recordPayment($out_trade_no, $trade_no) {
        $order = PlacedOrder::find(substr($out_trade_no, 2));
        if (!isset($order->payment_ref_no) && $order->order_status == 1) {
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
        }
    }
    
    private function validateAddress() {
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

<?php

/**
 * Description of OrderController
 *
 * @author Allen
 */
class OrderController extends BaseController{
    
    public function postSubmitOrder (){
        $items = OrderLineItem::ofMember(Auth::id())->get();
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
            return Redirect::to('/');
        }
        
        $alipayController = new AlipayController();
        
        $orderId = Input::get('order_id');
        $order = PlacedOrder::find($orderId);
        $price = $order->total_transaction_amount;
        $tradeNumber = $alipayController->generateTradeNumber($orderId);
        $address = new Address;
        $address->recipient_name = $order->recipient_name;
        $address->receive_zip = $order->receive_zip;
        $address->receive_phone = $order->receive_phone;
        $address->receive_address = $order->receive_address;

        
        return $alipayController->generateAlipayPage($tradeNumber, $price, $address);
    }
    
    
    public function insertOrder ($items, $paymentMethod, $amount, $address, $couponId){
        $order = new PlacedOrder;
        $order->member = Auth::id();
        $order->coupon = $couponId;
        $order->payment_method = $paymentMethod;
        $order->total_transaction_amount = $amount;
        $order->currency_code = 'RMB';
        $order->order_status = 1;
        $order->recipient_name = $address->recipient_name;
        $order->receive_address = $address->receive_address;
        $order->receive_zip = $address->receive_zip;
        $order->receive_phone = $address->receive_phone;
        
        $order->invoice_header = Input::get('invoice_header');
        $order->message_to_seller = Input::get('message_to_seller');
        
        if (isset($couponId)){
            $order->coupon = $couponId;
        }
        
        $order->save();
        
        foreach($items as $item) {
            $item->order_id = $order->order_id;
            $item->save();
            $model = $item->product()->first()->productModel()->first();
            $model->num_items_sold_display += rand(1, 5);
            $model->save();
        }
        return $order;
    }
    
}

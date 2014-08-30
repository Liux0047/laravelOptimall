<?php

/**
 * Description of OrderController
 *
 * @author Allen
 */
class OrderController extends BaseController{
    
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
        if (isset($couponId)){
            $order->coupon = $couponId;
        }
        
        $order->save();
        
        foreach($items as $item) {
            $item->order_id = $order->order_id;
            $item->save();
        }
        
        return $order;
    }
    
}

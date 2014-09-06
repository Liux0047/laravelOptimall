<?php

/**
 * Description of AdminFunctionController
 *
 * @author Allen
 */
class AdminFunctionController extends BaseController {
        
    public function getIndex() {
        return $this->getUndispatchedOrders();        
    }
    
    public function getUndispatchedOrders () {
        $params['pageTitle'] = "未发货的订单";
        $orders = PlacedOrder::where('order_status','=',1)->paginate(15);
        $params['orders'] = $orders;
        $params['items'] = array();
        foreach($orders as $order) {
           $params['items'][$order->order_id] = OrderLineItemView::ofOrder($order->order_id)->get();
        }
        return View::make('pages.admin.order-management', $params);
    }
}

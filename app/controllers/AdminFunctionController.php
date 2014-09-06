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

    public function getUndispatchedOrders() {
        $params['pageTitle'] = "未发货的订单";
        $orders = PlacedOrder::undispatched()->orderBy('created_at')->paginate(10);
        $params['orders'] = $orders;
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.admin.undispatched-orders', $params);
    }

    public function postDispatchOrder() {
        $order = PlacedOrder::findOrFail(Input::get('order_id'));
        if ($order->order_status == 2) {
            $order->order_status = 3;
            $order->save();
            return Redirect::back()->with('status', '确认发货成功');
        }
        else {
            return Redirect::back()->with('error', '无法发货，须买家付款之后');;
        }
    }

}

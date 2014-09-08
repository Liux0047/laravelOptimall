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
        return View::make('pages.admin.orders', $params);
    }

    public function getDispatchedOrders() {
        $params['pageTitle'] = "已发货的订单";
        $orders = PlacedOrder::dispatched()->orderBy('created_at', 'DESC')->paginate(10);
        $params['orders'] = $orders;
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.admin.orders', $params);
    }

    public function postDispatchOrder() {
        $order = PlacedOrder::findOrFail(Input::get('order_id'));
        if ($order->order_status_id == 2) {
            $order->order_status_id = 3;
            $order->dispatched_at = (new DateTime)->format('Y-m-d H:i:s');
            $order->dispatched_by = Session::get('admin.username');
            $order->shipping_company = Input::get('shipping_company');
            $order->shipping_track_num = Input::get('shipping_track_num');
            $order->dispatched_by = Session::get('admin.username');
            $order->save();
            return Redirect::back()->with('status', '确认发货成功');
        } else {
            return Redirect::back()->with('error', '无法发货，须买家付款之后');
        }
    }

    public function getPendingRefundClaims() {
        $params['pageTitle'] = "未处理的退款申请";
        $params['refunds'] = Refund::pending()->orderBy('created_at')->paginate(10);
        return View::make('pages.admin.refund', $params);
    }

    public function getRefundedClaims() {
        $params['pageTitle'] = "已经退款";
        $params['refunds'] = Refund::refunded()->orderBy('created_at', 'DESC')->paginate(10);
        return View::make('pages.admin.refund', $params);
    }

    public function postRefund() {
        $refund = Refund::findOrFail(Input::get('refund_id'));
        if ($refund->refund_status_id == 1) {
            $refund->amount = Input::get('amount');
            $refund->refund_status_id = 2;
        } else if ($refund->refund_status_id == 2) {
            $refund->refund_status_id = 3;
        } else if ($refund->refund_status_id == 3) {
            $refund->refund_status_id = 4;
        }
        $refund->save();
        return Redirect::back()->with('status', '成功处理退款申请');
    }

    public function getAmbassadorClaim() {
        
    }

    public function postAmbassadorClaim() {
        
    }

    public function getAmbassadorApproval() {
        
    }

    public function postAmbassadorApproval() {
        
    }

}

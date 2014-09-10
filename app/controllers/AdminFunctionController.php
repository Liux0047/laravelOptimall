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

    public function getRejectedClaims() {
        $params['pageTitle'] = "已经驳回退款";
        $params['refunds'] = Refund::rejected()->orderBy('created_at', 'DESC')->paginate(10);
        return View::make('pages.admin.refund', $params);
    }

    public function postRefund() {
        $validator = $this->validateClaimRefund();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $refund = Refund::findOrFail(Input::get('refund_id'));
        if ($refund->refund_status_id == 1) {
            $refund->amount = Input::get('amount');
            $refund->refund_status_id = 2;
        } else if ($refund->refund_status_id == 2) {
            $refund->refund_status_id = 3;
        } else if ($refund->refund_status_id == 3) {
            $refund->refund_status_id = 4;
        }
        $refund->processed_by = Session::get('admin.username');
        $refund->save();
        return Redirect::back()->with('status', '成功处理退款申请');
    }

    public function postRejectRefund() {
        $refund = Refund::findOrFail(Input::get('refund_id'));
        $refund->is_rejected = 1;
        $refund->processed_by = Session::get('admin.username');
        $refund->save();
        return Redirect::back()->with('status', '成功驳回退款申请');
    }

    public function getAmbassadorClaim() {
        $params['pageTitle'] = "目光之星返利申请";
        $params['claims'] = AmbassadorView::ambassadorRewardClaims()->paginate(10);
        $params['rewards'] = AmbassadorController::calculateRewards($params['claims']);
        $params['formRequired'] = true;
        return View::make('pages.admin.ambassador-claim', $params);
    }
    
    public function getProcessedAmbassadorClaim() {
        $params['pageTitle'] = "目光之星返利申请";
        $params['claims'] = AmbassadorView::ambassadorRewardProcessed()->paginate(10);
        $params['rewards'] = AmbassadorController::calculateRewards($params['claims']);
        $params['formRequired'] = false;
        return View::make('pages.admin.ambassador-claim', $params);
    }

    public function postAmbassadorClaim() {
        if (Input::has('orders')) {
            $orderIds = Input::get('orders');
            foreach ($orderIds as $orderId) {
                $order = PlacedOrder::findOrFail($orderId);
                $order->is_ambassador_reward_processed = 1;
                $order->save();
            }
            return Redirect::back()->with('status', '成功确认返利');
        } else {
            return Redirect::back()->with('error', '没有选择任何订单');
        }
    }

    public function getAmbassadorApproval() {
        
    }

    public function postAmbassadorApproval() {
        
    }

    private function validateClaimRefund() {
        $rules = array(
            'amount' => 'required|numeric'
        );
        return Validator::make(Input::all(), $rules);
    }

}

<?php

/**
 * Description of AdminFunctionController
 *
 * @author Allen
 */
class AdminFunctionController extends BaseController
{

    public function getIndex()
    {
        return $this->getUndispatchedOrders();
    }

    public function getUndispatchedOrders()
    {
        $params['pageTitle'] = "未发货的订单";
        $orders = PlacedOrder::undispatched()->orderBy('created_at')->paginate(10);
        $params['orders'] = $orders;
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.admin.orders', $params);
    }

    public function getDispatchedOrders()
    {
        $params['pageTitle'] = "已发货的订单";
        $orders = PlacedOrder::dispatched()->orderBy('created_at', 'DESC')->paginate(10);
        $params['orders'] = $orders;
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.admin.orders', $params);
    }

    public function getUnpaidOrders()
    {
        $params['pageTitle'] = "未付款的订单";
        $orders = PlacedOrder::unpaid()->orderBy('created_at', 'DESC')->paginate(10);
        $params['orders'] = $orders;
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.admin.orders', $params);
    }

    public function postDispatchOrder()
    {
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

    public function getPendingRefundClaims()
    {
        $params['pageTitle'] = "未处理的退款申请";
        $params['refunds'] = Refund::pending()->orderBy('created_at')->paginate(10);
        return View::make('pages.admin.refund', $params);
    }

    public function getRefundedClaims()
    {
        $params['pageTitle'] = "已经退款";
        $params['refunds'] = Refund::refunded()->orderBy('created_at', 'DESC')->paginate(10);
        return View::make('pages.admin.refund', $params);
    }

    public function getRejectedClaims()
    {
        $params['pageTitle'] = "已经驳回退款";
        $params['refunds'] = Refund::rejected()->orderBy('created_at', 'DESC')->paginate(10);
        return View::make('pages.admin.refund', $params);
    }

    public function postRefund()
    {
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

    public function postRejectRefund()
    {

        $validator = $this->validateRejectRefund();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $refund = Refund::findOrFail(Input::get('refund_id'));
        $refund->is_rejected = 1;
        $refund->rejection_reason = Input::get('rejection_reason');
        $refund->processed_by = Session::get('admin.username');
        $refund->save();
        return Redirect::back()->with('status', '成功驳回退款申请');
    }

    public function getAmbassadorClaim()
    {
        $params['pageTitle'] = "目光之星返利申请";
        $params['claims'] = AmbassadorView::ambassadorRewardClaims()->paginate(10);
        $ambassadorController = new AmbassadorController();
        $params['rewards'] = $ambassadorController->calculateRewards($params['claims']);
        $params['formRequired'] = true;
        return View::make('pages.admin.ambassador-claim', $params);
    }

    public function getProcessedAmbassadorClaim()
    {
        $params['pageTitle'] = "目光之星返利申请";
        $params['claims'] = AmbassadorView::ambassadorRewardProcessed()->paginate(10);
        $ambassadorController = new AmbassadorController();
        $params['rewards'] = $ambassadorController->calculateRewards($params['claims']);
        $params['formRequired'] = false;
        return View::make('pages.admin.ambassador-claim', $params);
    }

    public function postAmbassadorClaim()
    {
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

    public function getAmbassadorApplication()
    {
        $params['pageTitle'] = "目光之星注册申请";
        $params['applications'] = Member::newAmbassadorApplication()->paginate(10);
        return View::make('pages.admin.ambassador-application', $params);
    }

    public function getApprovedAmbassadorApplication()
    {
        $params['pageTitle'] = "目光之星注册申请成功";
        $params['applications'] = Member::approvedAmbassadorApplication()->paginate(10);
        return View::make('pages.admin.ambassador-application', $params);
    }

    public function postAmbassadorApplication()
    {
        if (Input::has('member_id')) {
            $member = Member::findOrFail(Input::get('member_id'));
            $member->is_approved_ambassador = 1;
            $member->save();
            $data['nickname'] = $member->nickname;
            Mail::queue('emails.member.ambassador-approval', $data, function ($message) use ($member) {
                $message->to($member->email)->subject('恭喜您成为目光之星');
            });
            return Redirect::back()->with('status', '成功批准申请');
        } else {
            return Redirect::back()->with('error', '申请无效');
        }
    }

    public function getUnansweredQuestion()
    {
        $params['pageTitle'] = "用户提问";
        $questions = ProductQuestion::with('member')
            ->whereNull('answer')
            ->orderBy('created_at')
            ->paginate(20);
        $params['questions'] = $questions;
        return View::make('pages.admin.user-question', $params);

    }

    public function getAnsweredQuestion()
    {
        $params['pageTitle'] = "已回答的用户提问";
        $questions = ProductQuestion::with('member')
            ->whereNotNull('answer')
            ->orderBy('created_at')
            ->paginate(20);
        $params['questions'] = $questions;
        return View::make('pages.admin.user-question', $params);

    }

    public function getFakeReview()
    {
        $params['pageTitle'] = "Fake Review";
        return View::make('pages.admin.fake-review', $params);
    }

    public function postFakeReview()
    {

        $model = ProductModel::findOrFail(Input::get('model_id'));
        $productId = $model->products()->first()->product_id;

        $member = new Member;
        $member->email = Input::get('email');
        $member->password = Hash::make(Input::get('password'));
        $member->nickname = Input::get('nickname');
        $member->save();

        if (!isset($member->member_id)) {
            return Redirect::back()->with('error', 'Failed to create review - Member not created');
        }

        $order = new PlacedOrder;
        $order->member_id = $member->member_id;
        $order->recipient_name = 'Fake Review';
        $order->order_status_id = 3;
        $order->save();

        if (!isset($order->order_id)) {
            return Redirect::back()->with('error', 'Failed to create review - Order not created');
        }

        $item = new OrderLineItem;
        $item->member_id = $member->member_id;
        $item->order_id = $order->order_id;
        $item->lens_type_id = 1;
        $item->product_id = $productId;
        $item->save();

        if (!isset($item->order_line_item_id)) {
            return Redirect::back()->with('error', 'Failed to create review - Line Item not created');
        }

        $review = new Review;
        $review->order_line_item_id = $item->order_line_item_id;
        $review->title = Input::get('title');
        $review->design_rating = Input::get('design_rating', 5);
        $review->comfort_rating = Input::get('comfort_rating', 5);
        $review->quality_rating = Input::get('quality_rating', 5);
        $review->content = Input::get('content');
        $review->save();

        if (!isset($review->review_id)) {
            return Redirect::back()->with('error', 'Failed to create review - Review not created');
        }

        return Redirect::back()->with('status', 'Successfully created Review');

    }

    private function validateClaimRefund()
    {
        $rules = array(
            'amount' => 'required|numeric'
        );
        return Validator::make(Input::all(), $rules);
    }

    private function validateRejectRefund()
    {
        $rules = array(
            'rejection_reason' => 'required|max:200'
        );
        return Validator::make(Input::all(), $rules);
    }

}

<?php

/**
 * Description of MemberAccountController
 *
 * @author Allen
 */
class MemberAccountController extends BaseController {

    public function getShoppingHistory() {
        $params['pageTitle'] = "已下单 - 我的目光之城";

        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();

        $orders = PlacedOrder::ofMember(Auth::id())->orderBy('created_at', 'DESC')->get();
        $params['orders'] = $orders;

        $items = array();
        foreach ($orders as $order) {
            $items[$order->order_id] = OrderLineItemView::ofOrder($order->order_id)->get();
        }
        $params['items'] = $items;
        return View::make('pages.member.shopping-history', $params);
    }

    public function getSecurity() {
        $params['pageTitle'] = "安全设置 - 我的目光之城";
        return View::make('pages.member.security', $params);
    }

    public function postChangePassword() {
        $validator = $this->validateSecurity();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $currentPassword = Input::get('current_password');
        $newPassword = Input::get('new_password');
        $confirmPassword = Input::get('confirm_password');
        if ($newPassword !== $confirmPassword) {
            return Redirect::back()->with('error', '两次输入的密码不符合');
        }
        $credentials = array(
            'email' => Auth::user()->email,
            'password' => $currentPassword
        );
        if (Auth::validate($credentials)) {
            Auth::user()->password = Hash::make($newPassword);
            Auth::user()->save();
            return Redirect::back()->with('status', '密码修改成功');
        } else {
            return Redirect::back()->with('error', '密码修改失败');
        }
    }

    public function getMyPrescription() {
        $params['pageTitle'] = "验光单 - 我的目光之城";
        $params['prescriptions'] = Prescription::ofMember(Auth::id())->orderBy('created_at')->get();
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.member.my-prescription', $params);
    }

    public function postDeletePrescription() {
        $prescription = Prescription::findOrFail(Input::get('prescription_id'));
        if (isset($prescription) && $prescription->member == Auth::id()) {
            $prescription->delete();
            return Redirect::back()->with('status', '成功删除验光单');
        } else {
            return Redirect::back()->with('status', '没有找到这只验光单');
        }
    }

    public function getAmbassadorPanel() {
        $params['pageTitle'] = "目光之星 - 我的目光之城";
        if (!isset(Auth::user()->ambassadorInfo)) {
            $params['reward'] = array();
            $orders = AmbassadorView::ofAmbassador(Auth::id())->get();
            $params['ambassadorOrders'] = $orders;
            $reward = AmbassadorController::getRewards($orders);
            $params['reward'] = $reward['reward'];
            $params['totalReward'] = $reward['totalReward'];
            $params['overdueOrders'] = $reward['overdueOrders'];
            $params['isMinMet'] = $reward['isMinMet'];

            return View::make('pages.member.ambassador-panel', $params);
        }
        else {
            return View::make('pages.member.create-ambassador', $params);
        }
    }

    public function postClaimRefund() {
        $validator = $this->validateClaimRefund();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $item = OrderLineItem::findOrFail(Input::get('order_line_item_id'));
        if ($item->member != Auth::id()) {
            return Redirect::back()->with('error', '退款申请提失败');
        }

        $refund = new Refund;
        $refund->reason = Input::get('reason');
        $quantity = Input::get('quantity', 1);
        if ($quantity > $item->quantity) {   //if input quantity exceeds the line item quantity
            $quantity = $item->quantity;
        }
        $refund->quantity = $quantity;

        if (Input::hasFile('photo') && Input::file('photo')->isValid()) {
            if (Input::file('photo')->getSize() < 2 * pow(2, 20)) {
                $path = public_path();
                Input::file('photo')->move($path . '/images/uploads/refunds/', $item->order_line_item_id . ".jpg");
            } else {
                return Redirect::action('MemberAccountController@getShoppingHistory')->with('error', '文件尺寸过大，请重新上传');
            }
        }
        
        $refund->order_line_item = $item->order_line_item_id;
        $refund->save();
        return Redirect::back()->with('status', '退款申请提交成功');
    }

    private function validateSecurity() {
        $rules = array(
            'new_password' => 'required|min:6|max:16|alpha_num'
        );
        return Validator::make(Input::all(), $rules);
    }

    private function validateClaimRefund() {
        $rules = array(
            'reason' => 'required|max:150'
        );
        return Validator::make(Input::all(), $rules);
    }

}

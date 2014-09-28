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

        $orders = Auth::user()->placedOrders()->orderBy('created_at', 'DESC')->get();
        $params['orders'] = $orders;

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
        $params['prescriptions'] = Auth::user()->prescriptions()->orderBy('created_at')->get();
        $params['prescriptionNames'] = PrescriptionController::getPrescriptionNames();
        return View::make('pages.member.my-prescription', $params);
    }

    public function postDeletePrescription() {
        $prescription = Prescription::findOrFail(Input::get('prescription_id'));
        if (isset($prescription) && $prescription->member_id == Auth::id()) {
            $prescription->delete();
            return Redirect::back()->with('status', '成功删除验光单');
        } else {
            return Redirect::back()->with('status', '没有找到这只验光单');
        }
    }

    public function getAmbassadorPanel() {
        $params['pageTitle'] = "目光之星 - 我的目光之城";        
        if (Auth::user()->ambassadorInfo()->count() > 0) {
            $params['reward'] = array();
            $params['ambassadorInfo'] = Auth::user()->ambassadorInfo;
            $orders = AmbassadorView::ofAmbassador(Auth::id())->get();
            $params['ambassadorOrders'] = $orders;
            $ambassadorController = new AmbassadorController();
            $params['rewards'] = $ambassadorController->calculateRewards($orders);
            $params['totalRewards'] = $ambassadorController->getTotalRewards();
            $params['isMinMet'] = $ambassadorController->isMinRewardMet();
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
        if ($item->member_id != Auth::id()) {
            return Redirect::back()->with('error', '退款申请提失败');
        }

        $refund = new Refund;
        $refund->reason = Input::get('reason');
        $quantity = Input::get('quantity', 1);
        if ($quantity > $item->quantity) {   //if input quantity exceeds the line item quantity
            $quantity = $item->quantity;
        }
        $refund->quantity = $quantity;
        $refund->refund_status_id = 1;
        $refund->order_line_item_id = $item->order_line_item_id;
        $refund->save();
        
        //save refund claim picture uploaded by user
        if (Input::hasFile('photo') && Input::file('photo')->isValid()) {
            if (Input::file('photo')->getSize() < 2 * pow(2, 20)) {
                Input::file('photo')->move(Config::get('optimall.refundPicPath'), $refund->refund_id . ".jpg");
            } else {
                return Redirect::action('MemberAccountController@getShoppingHistory')->with('error', '文件尺寸过大，请重新上传');
            }
        }
        
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

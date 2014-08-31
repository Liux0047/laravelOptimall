<?php

/**
 * Description of MemberAccountController
 *
 * @author Allen
 */
class MemberAccountController extends BaseController {

    public function getShoppingHistory() {
        $params['pageTitle'] = "已下单 - 我的目光之城";

        $params['prescriptionNames']['O_S_LEFTNames'] = ShoppingCartController::$O_S_LEFTNames;
        $params['prescriptionNames']['O_D_RIGHTNames'] = ShoppingCartController::$O_D_RIGHTNames;
        $params['prescriptionNames']['CommonNames'] = ShoppingCartController::$CommonNames;

        $orders = PlacedOrder::ofMember(Auth::id())->get();
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
        $currentPassword = Input::get('current_password');
        $newPassword = Input::get('new_password');
        $confirmPassword = Input::get('confirm_password');
        if ($newPassword !== $confirmPassword) {
            return Redirect::back()->with('error','两次输入的密码不符合');
        }
        $credentials = array(
            'email' => Auth::user()->email,
            'password'=>$currentPassword
        );
        if (Auth::validate($credentials)) { 
            Auth::user()->password = Hash::make($newPassword);
            Auth::user()->save();
            return Redirect::back()->with('status','密码修改成功');
        }
        else {
            return Redirect::back()->with('error','密码修改失败');
        }
    }
    
    public function getMyPrescription () {
        $params['pageTitle'] = "验光单 - 我的目光之城";
        $params['prescriptions'] = Prescription::ofMember(Auth::id())->get();
        $params['prescriptionNames']['O_S_LEFTNames'] = ShoppingCartController::$O_S_LEFTNames;
        $params['prescriptionNames']['O_D_RIGHTNames'] = ShoppingCartController::$O_D_RIGHTNames;
        $params['prescriptionNames']['CommonNames'] = ShoppingCartController::$CommonNames;
        return View::make('pages.member.my-prescription', $params);
    }
    
    public function postDeletePrescription () {
        $prescription = Prescription::find(Input::get('prescription_id'));
        if (isset($prescription)){
            $prescription->delete();
            return Redirect::back()->with('status','成功删除验光单');
        }
        else {
            return Redirect::back()->with('status','没有找到这只验光单');
        }
        
    }

}

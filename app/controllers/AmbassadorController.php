<?php

/**
 * Description of AmbassadorController
 *
 * @author Allen
 */
class AmbassadorController extends BaseController {
    
    public function getAmabassador () {
        $params['pageTitle'] = "目光之城形象大使";
        return View::make('pages.ambassador.ambassador', $params);
    }

    public function postCreateAmbassador() {
        $params['pageTitle'] = "目光之城形象大使";
        
        //if member has not registered as ambassador
        if (!isset(Auth::user()->ambassador_code) || strlen(Auth::user()->ambassador_code)==0) {              
            $params['isAlreadyAmbassador'] = false;
            $code = $this->generateUniqueId();
            $params['amabassadorCode'] = $code;
            Auth::user()->ambassador_code = $code;
            Auth::user()->alipay_account = Input::get('alipay_account');
            Auth::user()->save();
            return View::make('pages.ambassador.ambassador-created', $params);
        }
        else {
            $params['isAlreadyAmbassador'] = true;
            return View::make('pages.ambassador.ambassador-created', $params);
        }
    }
    
    public function postChangeAlipayAccount () {
        if (Input::has('alipay_account')){
            Auth::user()->alipay_account = Input::get('alipay_account');
            Auth::user()->save();
            return Redirect::back()->with('status','成功更新支付宝账号');
        }
        else {
            return Redirect::back()->with('error','更新支付宝账号失败');
        }
    }
    
    public function postClaimRewards () {
        $orders = AmbassadorView::ofAmbassador(Auth::id())->get();
        foreach ($orders as $order){
            $placedOrder = PlacedOrder::find($order->order_id);
            $placedOrder->is_ambassador_reward_claimed = true;
            $placedOrder->save();
        }
        return Redirect::back()->with('status','成功申请返利');
    }
    
    public static function createAmbassadorRealtion ($newMemberId, $code) {
        $ambassadorRelation = new AmbassadorRelation;
        $ambassadorId = Member::where('ambassador_code', '=', $code)->first()->member_id;
        if (isset($ambassadorId)){
            $ambassadorRelation->ambassador = $ambassadorId;
            $ambassadorRelation->invited_member = $newMemberId;
            $ambassadorRelation->save();
            return true;
        }
        else {
            return false;
        }        
    }
    
    public static function isAmbassadorCodeValid ($code) {
        return (Member::where('ambassador_code', '=', $code)->count() > 0);
    }

    private function generateUniqueId() {
        return uniqid();
    }

}

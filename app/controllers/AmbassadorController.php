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
        $reward = self::getRewards($orders);
        if (!$reward['isMinMet']){
            return Redirect::back()->with('error','没有到底最低返利要求');
        }
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
    
    public static function getRewards($orders) {
        $rewardParam['totalReward'] = 0;
        $rewardParam['reward'] = array();
        $rewardParam['overdueOrders'] = array();
        $dateNow = new DateTime();
        foreach ($orders as $order) {
            if ($order->is_first_purchase) {
                $rewardParam['reward'][$order->order_id] = $order->total_transaction_amount * Config::get('optimall.ambassadorFirstReward');
            } else {
                $rewardParam['reward'][$order->order_id] = $order->total_transaction_amount * Config::get('optimall.ambassadorSubsequentReward');
            }
            $dateDiff = abs($dateNow->diff(new DateTime($order->order_created_at))->days);
            //if not claimed and not overdue
            if (!$order->is_ambassador_reward_claimed) {
                if ($dateDiff > Config::get('optimall.ambassadorClaimDuration')){
                    $rewardParam['overdueOrders'][] = $order->order_id;
                }
                else {
                    $rewardParam['totalReward'] += $rewardParam['reward'][$order->order_id];
                }
                
            }
        }
        $rewardParam['isMinMet'] = $rewardParam['totalReward'] >= Config::get('optimall.minAmbassadorClaim');
        return $rewardParam;
    }

    private function generateUniqueId() {
        return uniqid();
    }

}

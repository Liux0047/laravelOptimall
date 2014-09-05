<?php

/**
 * Description of AmbassadorController
 *
 * @author Allen
 */
class AmbassadorController extends BaseController {

    public function getIntro() {
        $params['pageTitle'] = "目光之星";
        return View::make('pages.ambassador', $params);
    }

    public function postCreateAmbassador() {
        $params['pageTitle'] = "目光之星";

        $validator = $this->validateInput();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        //if member has not registered as ambassador
        if (isset(Auth::user()->ambassadorInfo)) {
            $ambassadorInfo = new AmbassadorInfo;
            $code = $this->generateUniqueId();
            $ambassadorInfo->alipay_account = Input::get('alipay_account');
            $ambassadorInfo->mobile_phone = Input::get('mobile_phone');
            $ambassadorInfo->ambassador_plan = Input::get('ambassador_plan');
            $ambassadorInfo->ambassador_code = $code;
            $ambassadorInfo->member = Auth::id();
            $ambassadorInfo->save();
            return Redirect::back()->with('status','成功注册为目光之星，请等待回复');
        } else {
            return Redirect::back()->with('warning','您已经是目光之星了');
        }
    }

    public function postChangeAlipayAccount() {

        $validator = $this->validateInput();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        
        Auth::user()->alipay_account = Input::get('alipay_account');
        Auth::user()->save();
        return Redirect::back()->with('status', '成功更新支付宝账号');
    }

    public function postClaimRewards() {
        $orders = AmbassadorView::ofAmbassador(Auth::id())->get();
        $reward = self::getRewards($orders);
        if (!$reward['isMinMet']) {
            return Redirect::back()->with('error', '没有到底最低返利要求');
        }
        foreach ($orders as $order) {
            $placedOrder = PlacedOrder::find($order->order_id);
            $placedOrder->is_ambassador_reward_claimed = true;
            $placedOrder->save();
        }
        return Redirect::back()->with('status', '成功申请返利');
    }

    public static function createAmbassadorRelation($newMemberId, $code) {
        $ambassadorRelation = new AmbassadorRelation;        
        if (Member::getAmbassador($code)->count() > 0) {
            $ambassadorId = Member::getAmbassador($code)->first()->member_id;
            $ambassadorRelation->ambassador = $ambassadorId;
            $ambassadorRelation->invited_member = $newMemberId;
            $ambassadorRelation->save();
            return true;
        } else {
            return false;
        }
    }

    public static function isAmbassadorCodeValid($code) {
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
                if ($dateDiff > Config::get('optimall.ambassadorClaimDuration')) {
                    $rewardParam['overdueOrders'][] = $order->order_id;
                } else {
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

    private function validateInput() {
        $rules = array(
            'alipay_account' => 'required|max:45',
            'mobile_phone' => 'required|max:20',
            'ambassador_plan' => 'required|max:100',
        );
        return Validator::make(Input::all(), $rules);
    }

}

<?php

/**
 * Description of AmbassadorController
 *
 * @author Allen
 */
class AmbassadorController extends BaseController {

    public function postCreateAmbassador() {
        $params['pageTitle'] = "目光之星";

        $validator = $this->validateCreateAmbassador();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        //if member has not registered as ambassador
        if (Auth::user()->ambassadorInfo()->count() == 0) {
            $ambassadorInfo = new AmbassadorInfo;
            $code = $this->generateUniqueId();
            $ambassadorInfo->alipay_account = Input::get('alipay_account');
            $ambassadorInfo->mobile_phone = Input::get('mobile_phone');
            $ambassadorInfo->ambassador_plan = Input::get('ambassador_plan');
            $ambassadorInfo->ambassador_code = $code;
            $ambassadorInfo->member_id = Auth::id();
            $ambassadorInfo->save();
            $data['nickname'] = Auth::user()->nickname;
            Mail::queue('emails.member.ambassador-application', $data, function($message) {
                $message->to(Auth::user()->email)->subject('目光之星申请提交成功');
            });
            return Redirect::back()->with('status', '成功注册为目光之星，请等待回复');
        } else {
            return Redirect::back()->with('warning', '您已经是目光之星了');
        }
    }

    public function postChangeAlipayAccount() {

        $validator = $this->validateAlipay();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        Auth::user()->ambassadorInfo->alipay_account = Input::get('alipay_account');
        Auth::user()->ambassadorInfo->save();
        return Redirect::back()->with('status', '成功更新支付宝账号');
    }

    public function postClaimRewards() {
        $orders = AmbassadorView::ofAmbassador(Auth::id())->get();
        $reward = self::calculateRewards($orders);
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

    public function postSendInvitation() {
        $data['nickname'] = Auth::user()->nickname;
        $data['couponCode'] = "WELCOME";
        $emails = preg_split("/[\s,;；，]+/", Input::get('emails'));
        foreach ($emails as $email) {
            Mail::queue('emails.member.invitation', $data, function($message) use ($email) {
                $message->to($email)->subject(Auth::user()->nickname . ' 邀请了你去逛逛目光之城');
            });
        }
        return Redirect::back()->with('status','成功发送邮件');
    }

    public static function findAmbassadorRelation($code) {        
        if (Member::getAmbassador($code)->count() > 0) {    //if code belongs to a valid ambassador
            return Member::getAmbassador($code)->first()->member_id;
        } else {
            return null;
        }
    }

    public static function isAmbassadorCodeValid($code) {
        return Member::getAmbassador($code)->count() > 0;
    }

    public static function calculateRewards($orders) {
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

    private function validateCreateAmbassador() {
        $rules = array(
            'alipay_account' => 'required|max:45',
            'mobile_phone' => 'required|max:20',
            'ambassador_plan' => 'required|max:100',
        );
        return Validator::make(Input::all(), $rules);
    }

    private function validateAlipay() {
        $rules = array(
            'alipay_account' => 'required|max:45'
        );
        return Validator::make(Input::all(), $rules);
    }

    private function validateInvitaion() {
        $rules = array(
            'email' => 'required|email|max:45'
        );
        return Validator::make(Input::all(), $rules);
    }
    

}

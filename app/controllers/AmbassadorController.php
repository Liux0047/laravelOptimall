<?php

/**
 * Description of AmbassadorController
 *
 * @author Allen
 */
class AmbassadorController extends BaseController {

    private $rewards;
    private $totalRewards;
    private $qualifiedOrders;

    public function __construct() {
        $this->rewards = array();
        $this->qualifiedOrders = array();
        $this->totalRewards = 0;
    }

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
            return Redirect::back()->with('status', '目光之星申请提交成功，请等待回复');
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
        $this->calculateRewards($orders);
        if (!$this->isMinRewardMet()) {
            return Redirect::back()->with('error', '没有到底最低返利要求');
        }
        foreach ($this->qualifiedOrders as $order) {
            $placedOrder = PlacedOrder::find($order->order_id);
            $placedOrder->is_ambassador_reward_claimed = true;
            $placedOrder->save();
        }
        return Redirect::back()->with('status', '成功申请返利');
    }

    public function postSendInvitation() {
        $validator = $this->validateInvitaion();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        
        $data['nickname'] = Auth::user()->nickname;
        $data['couponCode'] = "WELCOME";
        $email = Input::get('email');
                
        if (Auth::user()->is_approved_ambassador) {
            $data['invitatonCode'] = Auth::user()->ambassadorInfo->ambassador_code;
            $data['discount'] = Config::get('optimall.ambassadorInvitedReward') * 100;
        }
        
        Mail::send('emails.member.invitation', $data, function($message) use ($email) {
            $message->to($email)->subject(Auth::user()->nickname . ' 邀请了你去逛逛目光之城');
        });        
        $failed = Mail::failures();
        if (empty($failed)) {
            return Redirect::back()->with('status', '成功发送邮件至: ' . $email);
        } else {
            return Redirect::back()->with('error', '没有发送任何邮件');
        }
        /*
        $count = 0;
        $emailsList = array();
        foreach ($emails as $email) {
            $email = trim($email);
            if (!empty($email)) {
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                if ($email && !empty($email)) {
                    $count++;
                    $emailsList[] = $email;
                }
            }
        }
         * 
         */
        
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

    public function calculateRewards($orders) {
        foreach ($orders as $order) {
            if ($order->is_first_purchase) {
                //first purchase
                $this->rewards[$order->order_id]['amount'] = $order->total_transaction_amount * Config::get('optimall.ambassadorFirstReward');
            } else {
                //subsequent purchase within ambassadorSubsequentPeriod days
                $this->rewards[$order->order_id]['amount'] = $order->total_transaction_amount * Config::get('optimall.ambassadorSubsequentReward');
            }

            //if reward exceeds max reward claimable
            if ($this->rewards[$order->order_id]['amount'] > Config::get('optimall.ambassadorRewardCap')) {
                $this->rewards[$order->order_id]['amount'] = Config::get('optimall.ambassadorRewardCap');
            }

            if (!$order->is_ambassador_reward_claimed) {
                $isOverdue = $this->isRewardOverDue($order);
                $isNotConfirmed = $this->isRewardNotConfirmed($order);
                $this->rewards[$order->order_id]['isRewardOverDue'] = $isOverdue;
                $this->rewards[$order->order_id]['isRewardNotConfirmed'] = $isNotConfirmed;
                if (!$isOverdue && !$isNotConfirmed) {
                    $this->totalRewards += $this->rewards[$order->order_id]['amount'];
                    $this->qualifiedOrders[] = $order;
                }
            }
        }
        return $this->rewards;
    }

    public function isMinRewardMet() {
        return $this->totalRewards >= Config::get('optimall.minAmbassadorClaim');
    }

    public function getTotalRewards() {
        return $this->totalRewards;
    }

    /*
     * test whehter this order for ambassador reward is overdue
     */

    private function isRewardOverDue($order) {
        $daysOrderCreated = getDateDiffToNow($order->payment_time);
        return $daysOrderCreated > Config::get('optimall.ambassadorClaimDuration');
    }

    /*
     * test whehter this order for ambassador reward is NOT confirmed, 
     * ie. not after refund period expires
     */

    private function isRewardNotConfirmed($order) {
        $daysOrderCreated = getDateDiffToNow($order->payment_time);
        return $daysOrderCreated < Config::get('optimall.ambassadorOrderConfirmation');
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

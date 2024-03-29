<?php


/**
 * Description of CouponController
 *
 * @author Allen
 */
class CouponController extends BaseController
{

    const AMBASSADOR_COUPON = 1;
    const AMBASSADOR_INVITED_COUPON = 2;
    const ONE_TIME = 3;

    public static $discountRules = array(
        self::AMBASSADOR_COUPON => 'Coupon for Ambassador himself',
        self::AMBASSADOR_INVITED_COUPON => 'Coupon for members invited by Ambassador',
        self::ONE_TIME => 'Coupon for one time usage',
    );

    public function postApplyCoupon()
    {
        $coupon = Coupon::validCoupon(Input::get('coupon_code'))->first();
        if (isset($coupon) && $this->isEligibleForCoupon($coupon)) {    //if a valid coupon was found
            if ($coupon->couponUsages()->where('member_id', '=', Auth::id())->count() > 0) {
                //if this coupon has been used
                return Redirect::back()->with('error', '对不起，改消费卷已经被您使用');
            } else {
                Session::put('couponId', $coupon->coupon_id);
                return Redirect::back()->with('status', '成功添加消费卷');
            }
        } else {
            return Redirect::back()->with('error', '对不起，您输入的消费卷无效或者已经过期');
        }
    }

    public function postRemoveCoupon()
    {
        if (Session::has('couponId')) {
            Session::forget('couponId');
        }
        return Redirect::back()->with('status', '成功删除消费卷');
    }

    /*
     * Record this coupon usage
     * returns the coupon ID if successful
     */
    public function recordCouponUsage()
    {
        if (Session::has('couponId')) {
            $couponId = Session::get('couponId');
            $couponUsage = new CouponUsage;
            $couponUsage->coupon_id = $couponId;
            $couponUsage->member_id = Auth::id();
            $couponUsage->save();
            Session::forget('couponId');
            return $couponId;
        } else {
            return null;
        }
    }

    public function isEligibleForCoupon($coupon)
    {
        if (!isset($coupon->coupon_rule_id)) {
            //if no more additional rule, eligible
            return true;
        }
        switch ($coupon->coupon_rule_id) {
            case self::AMBASSADOR_COUPON:   //rule 1: must be an ambassador
                return Auth::user()->is_approved_ambassador;
            case self::AMBASSADOR_INVITED_COUPON:   //must have been invited by an ambassador
                if (!isset(Auth::user()->invited_by)) {
                    return false;
                } else {
                    return Member::find(Auth::user()->invited_by)->is_approved_ambassador;
                }
            case self::ONE_TIME:
                $usageCount = CouponUsage::where('coupon_id','=',$coupon->coupon_id)->count();
                if ($usageCount > 0) {
                    return false;
                } else {
                    return true;
                }
            default:
                return false;
        }
    }

    public static function getCoupon()
    {
        if (Session::has('couponId')) {
            return Coupon::find(Session::get('couponId'));
        } else {
            return null;
        }

    }

}

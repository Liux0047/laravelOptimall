<?php


/**
 * Description of CouponController
 *
 * @author Allen
 */
class CouponController extends BaseController {
    
    public function postApplyCoupon() {
        $coupon = Coupon::validCoupon(Input::get('coupon_code'))->first();
        if (isset($coupon)) {    //if a valid coupon was found
            if ($coupon->couponUsages()->where('member', '=', Auth::id())->count()) {
                //if this coupon has been used
                return Redirect::back()->with('error', '消费卷已经被使用');
            } else {
                Session::put('couponId', $coupon->coupon_id);
                return Redirect::back()->with('status', '成功添加消费卷');
            }
        } else {
            return Redirect::back()->with('error', '消费卷无效或者已经过期');
        }
    }
    
    public function postRemoveCoupon () {
        if (Session::has('couponId')){
            Session::forget('couponId');
        }
        return Redirect::back()->with('status','成功删除消费卷');
    }
    
    public static function getCoupon (){
        if (Session::has('couponId')){
            return Coupon::find(Session::get('couponId'));
        }
        else {
            return null;
        }
        
    }

}

<?php


/**
 * Description of CouponController
 *
 * @author Allen
 */
class CouponController extends BaseController {
    
    public function applyCoupon() {
        $coupon = Coupon::validCoupon(Input::get('coupon_code'))->first();
        if (isset($coupon)) {    //if a valid coupon was found
            if ($coupon->couponUsages()->where('member', '=', Auth::id())->count()) {
                //if this coupon has been used
                return Redirect::to('shopping-cart')->with('warning', '消费卷无效或者已经过期');
            } else {
                Session::put('couponId', $coupon->coupon_id);
                return Redirect::to('shopping-cart')->with('message', '成功添加消费卷');
            }
        } else {
            return Redirect::to('shopping-cart')->with('warning', '消费卷无效或者已经过期');
        }
    }
    
    public function removeCoupon () {
        if (Session::has('couponId')){
            Session::forget('couponId');
        }
        return Redirect::to('shopping-cart')->with('message','成功删除消费卷');
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coupon
 *
 * @author Allen
 */
class Coupon extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon';
    //primary ID
    protected $primaryKey = 'coupon_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * query for valid coupon for this coupon code
     * valid conditon: is active and has not expired
     */
    public function scopeValidCoupon($query, $couponCode) {
        return $query->where('expire_date', '>', new DateTime())
                        ->where('is_active', '=', '1')
                        ->where('coupon_code', '=', $couponCode);
    }
    
    /*
     * one to manay relationship to coupon usage
     */
    public function couponUsages (){
        return $this->hasMany('CouponUsage', 'coupon_id');
    }

}

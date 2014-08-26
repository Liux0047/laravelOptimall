<?php

/**
 * Description of CouponUsage
 *
 * @author Allen
 */
class CouponUsage extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon_usage';
    //primary ID
    protected $primaryKey = 'coupon_usage_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}
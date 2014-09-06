<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Member extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member';
    //primary ID
    protected $primaryKey = 'member_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /*
     * One to one relationship with ambassadorInfo
     */

    public function ambassadorInfo() {
        return $this->hasOne('AmbassadorInfo', 'member');
    }

    /*
     * One to many relationship with PlacedOrder
     */

    public function placedOrders() {
        return $this->hasMany('PlacedOrder', 'member_id');
    }

    /*
     * One to many relationship with orderLineItemView
     */

    public function orderLineItemViews() {
        return $this->hasMany('OrderLineItemView', 'member_id');
    }

    /*
     * One to many relationship with orderLineItem
     */

    public function orderLineItems() {
        return $this->hasMany('OrderLineItem', 'member_id');
    }

    /*
     * One to many relationship with Address
     */

    public function addresses() {
        return $this->hasMany('Address', 'member_id');
    }

    /*
     * One to many relationship with Prescription
     */

    public function prescriptions() {
        return $this->hasMany('Prescription', 'member_id');
    }
    
    /*
     * One to many relationship with ThumbUp
     */

    public function thumbUps() {
        return $this->hasMany('ThumbUp', 'member_id');
    }

    /*
     * Dynamic scope to get member ID given ambassador code
     */

    public function scopeGetAmbassador($query, $code) {
        return $query->select('member.member_id')
                        ->join('ambassador_info', 'ambassador_info.member_id', '=', 'member.member_id')
                        ->where('ambassador_info.ambassador_code', '=', $code)
                        ->where('member.is_approved_ambassador', '=', '1');
    }

}

<?php

/**
 * Description of Order
 *
 * @author Allen
 */
class PlacedOrder extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders_placed';
    //primary ID
    protected $primaryKey = 'order_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * One to many relationship with OrderLineItemViews
     */
    public function orderLineItemViews() {
        return $this->hasMany('OrderLineItemView','order_id');
    }
    
    /*
     * One to many relationship with OrderLineItems
     */
    public function orderLineItems() {
        return $this->hasMany('OrderLineItem','order_id');
    }

    /*
     * Inverse one to many relationship with member
     */

    public function member() {
        return $this->belongsTo('Member','member_id');
    }
    
    /*
     * inverse of one to many relationship with coupon
     */
    public function coupon () {
        return $this->belongsTo('Coupon','coupon_id');
    }
    
    /*
     * scope of undispatched orders
     */
    public function scopeUndispatched ($query) {
        return $query->where('order_status_id','<=',2);
    } 
    
    /*
     * Dynamic scope of dispatched orders
     */
    public function scopeDispatched ($query) {
        return $query->where('order_status_id','>',2);
    } 

    /*
     * query for first-time orders belonging to this ambassador
     */

    public function scopeOfAmbassadorFirstOrder($query, $id) {
        return $query->join('ambassador_relation', 'ambassador_relation.invited_member', '=', ' orders_placed.member')
                        ->where('cambassador_relation.ambassador', '=', $id)
                        ->where('is_first_purchase', '=', 'true');
    }

}

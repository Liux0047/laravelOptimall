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

    public function member($query, $id) {
        return $query->belongsTo('Member','member');
    }

    /*
     * query for first-time orders belonging to this ambassador
     */

    public function ofAmbassadorFirstOrder($query, $id) {
        return $query->join('ambassador_relation', 'ambassador_relation.invited_member', '=', ' orders_placed.member')
                        ->where('cambassador_relation.ambassador', '=', $id)
                        ->where('is_first_purchase', '=', 'true');
    }

}

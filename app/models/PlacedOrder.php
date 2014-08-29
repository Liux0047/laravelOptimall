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
     * query for orders belonging to this member
     */
    public function scopeOfMember($query, $id) {
        return $query->where('member','=',$id);
    }
}
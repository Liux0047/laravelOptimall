<?php

/**
 * Description of OrderLineItem
 *
 * @author Allen
 */
class OrderLineItem extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_line_item';
    //primary ID
    protected $primaryKey = 'order_line_item_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    public function product() {
        return $this->belongsTo('Product', 'product');
    }
    
    public function lensType() {
        return $this->belongsTo('LensType', 'lens_type');
    }
    
    /*
     * inverse of one to many relationship of PlacedOrder
     */
    public function placedOrder () {
        return $this->belongsTo('PlacedOrder','order_id');
    }
    
    /*
     * dynmaic scope to get items belonging to a member ID
     */
    public function scopeOfMember($query, $id) {
        return $query->whereNull('order_id')->where('member','=',$id);
    }

}

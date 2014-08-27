<?php

/**
 * Description of OrderLineItem
 *
 * @author Allen
 */
class OrderLineItemView extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_line_item_view';
    //primary ID
    protected $primaryKey = 'order_line_item_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token'); 

    
    /*
     * dynmaic scope to get irems belonging to a member ID
     */
    public function scopeOfMember($query, $id) {
        return $query->whereNull('order_id')->where('member','=',$id);
    }

}

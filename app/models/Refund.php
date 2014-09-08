<?php

/**
 * Description of Refund
 *
 * @author Allen
 */
class Refund extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refund';
    //primary ID
    protected $primaryKey = 'refund_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    /*
     * Inverse one to one relatoonship with orderLineItemfView
     */
    public function orderLineItemView(){
        return $this->belongsTo('OrderLineItemView', 'order_line_item_id');
    }
    
    
    public function scopePending($query) {
        return $query->where('refund_status_id','<','4');
    }
    
    public function scopeRefunded ($query) {
        return $query->where('refund_status_id','=','4');
    }


}
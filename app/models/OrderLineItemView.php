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
     * inverse of one to many relationship of PlacedOrder
     */
    public function placedOrder () {
        return $this->belongsTo('PlacedOrder','order_id');
    }
    
    /*
     * dynmaic scope to get items belonging to a member ID
     */
    public function scopeCartItems($query, $id) {
        return $query->whereNull('order_id')->where('member','=',$id);
    }
    
    /*
     * Dynamic scope to query for 'people viewed this item bought...'
     */
    public function scopeViewThisAlsoBuy ($query, $modelId) {
        return $query->select('model_id', DB::raw('count(*) AS times_bought'))
                ->whereRaw('`member_id` IN (select `member_id` from `view_item_history` where `model_id`='.$modelId.')')
                ->where('model_id','!=',$modelId)
                ->groupBy('model_id')
                ->orderBy('times_bought', 'DESC');
    }

}

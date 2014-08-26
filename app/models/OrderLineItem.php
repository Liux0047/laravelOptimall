<?php
/**
 * Description of OrderLineItem
 *
 * @author Allen
 */
class OrderLineItem extends Eloquent{
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
}
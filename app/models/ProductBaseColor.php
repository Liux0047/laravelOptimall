<?php

/**
 * Description of ProductBaseColor
 *
 * @author Allen
 */
class ProductBaseColor  extends Eloquent{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_base_color';
        
        //primary ID
        protected $primaryKey = 'base_color_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
}
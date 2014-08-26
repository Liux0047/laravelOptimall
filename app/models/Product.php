<?php

/**
 * Description of Product
 *
 * @author Allen
 */
class Product extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';
    //primary ID
    protected $primaryKey = 'product_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

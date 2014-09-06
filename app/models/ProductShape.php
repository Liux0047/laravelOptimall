<?php

/**
 * Description of ProductShape
 *
 * @author Allen
 */
class ProductShape extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_shape';
    //primary ID
    protected $primaryKey = 'product_shape_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

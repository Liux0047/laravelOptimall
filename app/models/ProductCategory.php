<?php

/**
 * Description of ProductCategory
 *
 * @author Allen
 */
class ProductCategory extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_category';
    //primary ID
    protected $primaryKey = 'product_category_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

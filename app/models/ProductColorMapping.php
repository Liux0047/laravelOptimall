<?php

/**
 * Description of ProductColorMapping
 *
 * @author Allen
 */
class ProductColorMapping extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_color_mapping';
    //primary ID
    protected $primaryKey = 'mapping_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

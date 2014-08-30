<?php

/**
 * Description of ProductColor
 *
 * @author Allen
 */
class ProductStyle extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_style';
    //primary ID
    protected $primaryKey = 'style_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');


}

<?php

/**
 * Description of ProductGender
 *
 * @author Allen
 */
class ProductGender extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_gender';
    //primary ID
    protected $primaryKey = 'product_gender_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

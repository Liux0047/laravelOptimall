<?php

/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/6/2014
 * Time: 11:24 AM
 */
class ProductFaceMapping extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_face_mapping';
    //primary ID
    protected $primaryKey = 'product_face_mapping_id';


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

} 
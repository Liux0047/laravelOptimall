<?php

/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/6/2014
 * Time: 11:23 AM
 */
class ProductFace extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_face';
    //primary ID
    protected $primaryKey = 'product_face_id';

    //gallery filters
    public static function getGalleryFilters()
    {
        return array(
            array('option_id' => 1, 'name' => '国字脸'),
            array('option_id' => 2, 'name' => '心形脸'),
            array('option_id' => 3, 'name' => '鹅蛋脸'),
            array('option_id' => 4, 'name' => '圆脸'),
            array('option_id' => 5, 'name' => '钻石型脸'),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

} 
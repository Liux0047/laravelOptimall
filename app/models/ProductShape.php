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

    //gallery filters 
    public static function getGalleryFilters() {
        return array(
            array("option_id" => 1, "name" => "矩形"),
            array("option_id" => 2, "name" => "圆形"),
            array("option_id" => 3, "name" => "椭圆"),
            array("option_id" => 4, "name" => "猫眼"),
            array("option_id" => 5, "name" => "旅行者"),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

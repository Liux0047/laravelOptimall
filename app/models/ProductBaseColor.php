<?php

/**
 * Description of ProductBaseColor
 *
 * @author Allen
 */
class ProductBaseColor extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_base_color';
    //primary ID
    protected $primaryKey = 'product_base_color_id';

    //gallery filters
    public static function getGalleryFilters() {
        return array(
            array("option_id" => 1, "name" => "黑色"),
            array("option_id" => 2, "name" => "蓝色"),
            array("option_id" => 3, "name" => "黄色"),
            array("option_id" => 4, "name" => "红色"),
            array("option_id" => 5, "name" => "豹斑"),
            array("option_id" => 6, "name" => "棕色"),
            array("option_id" => 7, "name" => "灰色"),
            array("option_id" => 8, "name" => "渐变"),
            array("option_id" => 9, "name" => "粉色"),
            array("option_id" => 10, "name" => "绿色"),
            array("option_id" => 11, "name" => "紫色"),
            array("option_id" => 12, "name" => "白色"),
            array("option_id" => 13, "name" => "金色"),
            array("option_id" => 14, "name" => "豹纹"),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

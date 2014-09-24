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

    //galler filter
    public static function getGalleryFilters() {
        return array(
            array("option_id" => 1, "name" => "男女通用"),
            array("option_id" => 2, "name" => "男士"),
            array("option_id" => 3, "name" => "女士"),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

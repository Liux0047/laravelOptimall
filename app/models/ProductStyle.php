<?php

/**
 * Description of ProductColor
 *
 * @author Allen
 */
class ProductStyle extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_style';
    //primary ID
    protected $primaryKey = 'product_style_id';

    //gallery filters
    public static function getGalleryFilters()
    {
        return array(
            array("option_id" => 1, "name" => "英伦学院"),
            array("option_id" => 2, "name" => "户外阳光"),
            array("option_id" => 3, "name" => "商务休闲"),
            array("option_id" => 4, "name" => "复刻经典"),
            array("option_id" => 5, "name" => "特立独行"),
            array("option_id" => 6, "name" => "摩登时代"),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

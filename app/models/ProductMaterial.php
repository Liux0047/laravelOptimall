<?php

/**
 * Description of ProductMaterial
 *
 * @author Allen
 */
class ProductMaterial extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_material';
    //primary ID
    protected $primaryKey = 'product_material_id';

    //gallery filters 
    public static function getGalleryFilters() {
        return array(
            array("option_id" => 1, "name" => "超韧钨钢"),
            array("option_id" => 2, "name" => "质感板材"),
            array("option_id" => 3, "name" => "轻柔TR"),
            array("option_id" => 4, "name" => "商务金属"),
            array("option_id" => 5, "name" => "手造原木"),
            array("option_id" => 6, "name" => "高雅尼龙"),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

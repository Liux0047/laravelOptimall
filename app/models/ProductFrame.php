<?php

/**
 * Description of ProductFrame
 *
 * @author Allen
 */
class ProductFrame extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_frame';
    //primary ID
    protected $primaryKey = 'product_frame_id';

    //gallery filters
    public static function getGalleryFilters()
    {
        return array(
            array("option_id" => 1, "name" => "全框"),
            array("option_id" => 2, "name" => "半框"),
            array("option_id" => 3, "name" => "无框"),
        );
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

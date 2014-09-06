<?php

/**
 * Description of product
 *
 * @author Allen
 */
class ProductView extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_view';
    //primary ID
    protected $primaryKey = 'product_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * Inverse One to many relationship with color
     */
    public function productColor() {
        return $this->belongsTo('ProductColor', 'product_color_id');
    }

}

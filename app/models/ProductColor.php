<?php

/**
 * Description of ProductColor
 *
 * @author Allen
 */
class ProductColor extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_color';
    //primary ID
    protected $primaryKey = 'color_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    /*
     * One to many relationship with base color mapping
     */
    public function productColorMapping() {
        return $this->hasMany('ProductColorMapping', 'product_color');
    }
}

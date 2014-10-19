<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/19/2014
 * Time: 5:21 PM
 */

class ProductTag extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_tag';
    //primary ID
    protected $primaryKey = 'product_tag_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * One to many relationship with productTagMapping
     */
    public function productTagMappings(){
        return $this->belongsTo('ProductTagMapping', 'product_tag_id');
    }


}
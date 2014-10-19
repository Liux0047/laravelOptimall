<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/19/2014
 * Time: 5:22 PM
 */

class ProductTagMapping extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_tag_mapping';
    //primary ID
    protected $primaryKey = 'product_tag_mapping_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * inverse of One to many relationship with productTagMapping
     */
    public function productTag(){
        return $this->belongsTo('ProductTag', 'product_tag_id');
    }


    /*
     * inverse of One to many relationship with productTagMapping
     */
    public function productModelView(){
        return $this->belongsTo('ProductModelView', 'model_id');
    }


}
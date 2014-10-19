<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/19/2014
 * Time: 5:55 PM
 */

class ProductMaterialMapping extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_material_mapping';
    //primary ID
    protected $primaryKey = 'product_material_mapping_id';


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    /*
     * inverse of one to many relationship with material
     */
    public function productMaterial () {
        return $this->belongsTo('ProductMaterial', 'product_material_id');
    }

} 
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
    protected $primaryKey = 'material_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

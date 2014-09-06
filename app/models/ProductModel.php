<?php

/**
 * Description of ProductModel
 *
 * @author Allen
 */
class ProductModel extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_model';
    //primary ID
    protected $primaryKey = 'model_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    public function productViews() {
        return $this->hasMany('ProductView','model_id');
    }

}

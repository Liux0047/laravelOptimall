<?php

/**
 * Description of productModel
 *
 * @author Allen
 */
class ProductModelView extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'model_view';
    //primary ID
    protected $primaryKey = 'model_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    public function products() {
        return $this->hasMany('ProductView','model');
    }

}

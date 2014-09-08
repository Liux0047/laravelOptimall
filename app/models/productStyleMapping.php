<?php
/**
 * Description of productStyleMapping
 *
 * @author Allen
 */
class productStyleMapping extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_style_mapping';
    //primary ID
    protected $primaryKey = 'product_style_mapping_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

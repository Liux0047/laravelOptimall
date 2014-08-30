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
    protected $primaryKey = 'frame_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

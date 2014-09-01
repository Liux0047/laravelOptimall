<?php

/**
 * Description of Refund
 *
 * @author Allen
 */
class Refund extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refund';
    //primary ID
    protected $primaryKey = 'refund_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');


}
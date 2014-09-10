<?php
/**
 * Description of AmbassadorInfo
 *
 * @author Allen
 */
class AmbassadorInfo extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ambassador_info';
    //primary ID
    protected $primaryKey = 'ambassador_info_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
}
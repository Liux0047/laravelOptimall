<?php

/**
 * Description of Admin
 *
 * @author Allen
 */
class Admin extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin';
    //primary ID
    protected $primaryKey = 'admin_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    /*
    public function scopeOfMember ($query, $id) {
        return $query->where('member','=',$id);
    }
     * 
     */
}
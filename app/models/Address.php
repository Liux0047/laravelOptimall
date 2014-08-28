<?php


/**
 * Description of Address
 *
 * @author Allen
 */
class Address extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'address';
    //primary ID
    protected $primaryKey = 'address_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    public function scopeOfMember ($query, $id) {
        return $query->where('member','=',$id);
    }
}
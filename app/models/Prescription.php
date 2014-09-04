<?php


/**
 * Description of Prescription
 *
 * @author Allen
 */
class Prescription extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prescription';
    //primary ID
    protected $primaryKey = 'prescription_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    /*
     * dynmaic scope to get prescription of a member ID
     */
    public function scopeOfMember($query, $id) {
        return $query->where('member','=',$id)->orderBy('created_at','DESC');
    }
    
}
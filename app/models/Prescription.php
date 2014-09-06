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
     * Inverse one to many relationship with member
     */
    public function member() {
        return $this->belongsTo('Member','member_id');
    }
    
}
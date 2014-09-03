<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThumbUp
 *
 * @author Allen
 */
class ThumbUp extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thumb_up';
    //primary ID
    protected $primaryKey = 'thumb_up_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    /*
     * Dynamic scope to get all thumbups by a member
     */
    public function scopeOfMember ($query, $memberId) {
        return $query->where('member','=',$memberId);
    }
}


<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReviewReplay
 *
 * @author Allen
 */
class ReviewReply extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'review_reply';
    //primary ID
    protected $primaryKey = 'review_reply_id';
    
    
    /*
     * inverse one to many relationship with review
     */
    public function review(){
        return $this->belongsTo('Review','review_id');
    }
    
    /*
     * inverse one to many relationship with member
     */
    public function member () {
        return $this->belongsTo('Member','member_id');
    }
}

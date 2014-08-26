<?php

/**
 * Description of Review
 *
 * @author Allen
 */
class Review extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'review';
    //primary ID
    protected $primaryKey = 'review_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}

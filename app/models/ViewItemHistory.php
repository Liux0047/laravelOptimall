<?php


/**
 * Description of ViewHistory
 *
 * @author Allen
 */
class ViewItemHistory extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'view_item_history';
    //primary ID
    protected $primaryKey = 'view_item_history_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');


}
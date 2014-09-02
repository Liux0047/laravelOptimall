<?php

/**
 * Description of AmbassadorView
 *
 * @author Allen
 */
class AmbassadorView extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ambassador_view';
    //primary ID
    protected $primaryKey = 'order_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    /*
     * Dynamic scope to query all orders belonging to this ambassador
     */
    public function scopeOfAmbassador($query, $id) {                
        return $query->where('ambassador', '=', $id);
                                        
    }

}

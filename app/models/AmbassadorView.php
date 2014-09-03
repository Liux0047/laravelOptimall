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
        $daysDiff = Config::get('optimall.ambassadorSubsequentPeriod');
        $orderConfirmation = Config::get('optimall.ambassadorOrderConfirmation');
        // from this ambassador' id
        // order created within the valid reward duration
        // order created 40 days before and (either first purchase or subsequent purchase within 60 days)
        return $query->whereRaw(' `ambassador` = ' . $id . ' and  '
                        . '`order_created_at` <= DATE_SUB(NOW(),INTERVAL ' . $orderConfirmation . ' DAY) and '
                        . '(`is_first_purchase`=true '
                        . 'or DATEDIFF(`order_created_at`, `ambassador_relation_created_at`) < ' . $daysDiff . ')');
    }

}

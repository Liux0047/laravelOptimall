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
     * Inverse one to many relationship with member AS ambassador
     */
    public function ambassador() {
        return $this->belongsTo('Member', 'ambassador_id');
    }

    /*
     * Inverse one to one relationship with member AS invited_member
     */

    public function invitedMember() {
        return $this->belongsTo('Member', 'invited_member_id');
    }

    /*
     * scope to query all orders belonging to all ambassadors
     */

    public function scopeAmbassadorRewardClaims($query) {
        // from this ambassador' id
        // order created within the valid reward duration
        // and (either first purchase or subsequent purchase within 60 days)
        return $query->whereRaw('`is_ambassador_reward_claimed`=1 and `is_ambassador_reward_processed`=0 and ' . $this->rewardCondition());
    }

    /*
     * scope to query all orders belonging to all ambassadors
     */

    public function scopeAmbassadorRewardProcessed($query) {
        // from this ambassador' id
        // order created within the valid reward duration
        // before and (either first purchase or subsequent purchase within 60 days)
        return $query->whereRaw('`is_ambassador_reward_claimed`=1 and `is_ambassador_reward_processed`=1 and ' . $this->rewardCondition());
    }

    /*
     * Dynamic scope to query all orders belonging to this ambassador
     */

    public function scopeOfAmbassador($query, $id) {
        // from this ambassador' id
        // order created within the valid reward duration
        // and (either first purchase or subsequent purchase within 60 days)
        return $query->whereRaw(' `ambassador_id` = ' . $id . ' and  ' . $this->rewardCondition());
    }

    private function rewardCondition() {
        $daysDiff = Config::get('optimall.ambassadorSubsequentPeriod');
        return '(`is_first_purchase`=true '
                . 'or DATEDIFF(`order_created_at`, `ambassador_relation_created_at`) < ' . $daysDiff . ')';
    }

}

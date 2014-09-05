<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Member extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'member';
        
        //primary ID
        protected $primaryKey = 'member_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
        
        /*
         * Dynamic scope to get member ID given ambassador code
         */
        public function scopeGetAmbassador ($query, $code) {
            return $query->select('member.member_id')
                    ->join('ambassador_info','ambassador_info.ambassador_info_id','=','member.ambassador_info')
                    ->where('ambassador_code', '=', $code);
        }

}

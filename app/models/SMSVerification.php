<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 3/2/2015
 * Time: 8:45 PM
 */

class SMSVerification extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sms_verification';
    //primary ID
    protected $primaryKey = 'sms_verification_id';

}

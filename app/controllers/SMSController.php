<?php

/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 3/2/2015
 * Time: 10:48 PM
 */
class SMSController
{

    const REGISTRATION = 0;
    const PASSWORD_REMINDER = 1;

    public static function sendSMS($number, $message)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-57ecd4f230aa3a754c04af368e528945');

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $number, 'message' => $message . '【目光之城】'));

        $res = curl_exec($ch);
        curl_close($ch);
        //$res  = curl_error( $ch );
        var_dump($res);
    }


    public static function validateMobileNumber($fieldName)
    {
        $rules = array(
            $fieldName => 'required|digits:11'
        );
        return Validator::make(Input::only($fieldName), $rules);
    }

    public static function generateVerificationCode()
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;

    }

    public static function verifyMobileCode($mobileNumber, $code, $purpose)
    {
        $verification = SMSVerification::where('mobile_number', '=', $mobileNumber)
            ->where('verification_code', '=', $code)
            ->where('purpose', '=', $purpose)
            ->orderBy('created_at', 'desc')
            ->first();

        if (empty($verification)) {
            return false;
        } else {
            $createdAt = new DateTime($verification->created_at);
            $now = new DateTime();
            $diffInSeconds = $now->getTimestamp() - $createdAt->getTimestamp();
            if ($diffInSeconds > 10 * 60) { //after 10 minutes
                return false;
            }
        }

        return true;
    }

}
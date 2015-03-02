<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 3/2/2015
 * Time: 10:48 PM
 */

class SMSController {

    public static function sendSMS ($number, $message) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-57ecd4f230aa3a754c04af368e528945');

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $number, 'message' => $message. '【目光之城】'));

        $res = curl_exec($ch);
        curl_close($ch);
        //$res  = curl_error( $ch );
        var_dump($res);
    }
}
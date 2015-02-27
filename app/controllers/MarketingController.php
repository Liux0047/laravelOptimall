<?php

/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 2/25/2015
 * Time: 9:51 AM
 */
class MarketingController extends BaseController
{

    public function getTuan()
    {

        $numJoined = TuanGou::where('is_verified', '=', '1')->count();

        $params['numJoined'] = $numJoined;

        return View::make('pages.marketing.tuan', $params);
    }

    public function getJoinTuan()
    {
        return View::make('pages.marketing.join-tuan');
    }

    public function postJoinTuan()
    {

        $phoneNumber = Input::get('phone_number');
        if (!is_numeric($phoneNumber) || strlen($phoneNumber) != 11) {
            return Redirect::back()->with('error', '手机号码格式不正确');

        } else {
            $verificationCode = $this->generateVerificationCode();
            $this->sendVerificationCode($verificationCode);

            $tuanEntry = new TuanGou;
            $tuanEntry->phone_number = $phoneNumber;
            $tuanEntry->verification_code = $verificationCode;
            $tuanEntry->save();
            Session::put('tuanGouId', $tuanEntry->tuan_gou_id);
            return Redirect::action('MarketingController@getVerifyTuan');
        }

    }

    public function getVerifyTuan()
    {
        return View::make('pages.marketing.verify-tuan');
    }

    public function postVerifyTuan()
    {
        $tuanEntry = TuanGou::find(Session::get('tuanGouId'));
        if (strcasecmp($tuanEntry->verification_code, Input::get('code')) != 0) {
            return Redirect::back()->with('error', '验证码不正确');
        } else {
            $tuanEntry->is_verified = 1;
            $tuanEntry->save();
            return Redirect::action('MarketingController@getVerifyTuanSuccess');
        }

    }

    public function getVerifyTuanSuccess()
    {
        return View::make('pages.marketing.verify-tuan-success');
    }

    private function generateVerificationCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;

    }

    private function sendVerificationCode($code)
    {

    }

}
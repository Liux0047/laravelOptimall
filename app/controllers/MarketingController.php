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
        $params['isVerified'] = false;
        if (Session::has('tuanGouId')) {
            $tuanEntry = TuanGou::find(Session::get('tuanGouId'));
            if ($tuanEntry->is_verified) {
                $params['isVerified'] = true;
                Session::forget('tuanGouId');
            }
        }
        return View::make('pages.marketing.tuan', $params);
    }

    public function postJoinTuan()
    {
        $phoneNumber = Input::get('phone_number');
        if (!is_numeric($phoneNumber) || strlen($phoneNumber) != 11) {
            return Response::json(array('isValid' => 'false', 'message' => '手机号码格式不正确'));;

        } else if (TuanGou::where('phone_number', '=', $phoneNumber)->count()) {
            return Response::json(array('isValid' => 'false', 'message' => '该号码已经加入团购'));
        } else {
            $verificationCode = $this->generateVerificationCode();
            $this->sendVerificationCode($verificationCode);

            $tuanEntry = new TuanGou;
            $tuanEntry->phone_number = $phoneNumber;
            $tuanEntry->verification_code = $verificationCode;
            $tuanEntry->save();
            Session::put('tuanGouId', $tuanEntry->tuan_gou_id);
            return Response::json(array('isValid' => 'true'));
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
            return Redirect::action('MarketingController@getTuan');
        }

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
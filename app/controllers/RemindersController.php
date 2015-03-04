<?php

class RemindersController extends Controller
{

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        return View::make('pages.password.remind');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        switch ($response = Password::remind(Input::only('email'), function ($message) {
            $message->subject('重置密码请求');
        })) {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    /**
     * Handle a POST request to remind a user of their password using mobile.
     *
     * @return Response
     */
    public function postRemindMobile() {
        $mobileNumber = Input::get('mobile_number');

        if (!SMSController::verifyMobileCode($mobileNumber, Input::get('verification_code'), SMSController::PASSWORD_REMINDER)) {
            return Redirect::back()->with('error', '对不起,您输入的验证码有误，请重试');
        }

        $member = Member::where('mobile_number', '=', $mobileNumber)
            ->first();

        if (empty($member)){
            return Redirect::back()->with('error', '对不起，手机号码似乎不对，请再试试');
        } else {
            return View::make('pages.password.reset-mobile')->with('verificationCode', Input::get('verification_code'));
        }
    }

    public function postSendVerificationCode()
    {
        $validator = SMSController::validateMobileNumber('mobile_number');
        if ($validator->fails()) {
            return Response::json(array('isSent' => 0, 'message' => '号码无效'));
        }

        $mobileNumber = Input::get('mobile_number');
        $sms = new SMSVerification;
        $sms->mobile_number = $mobileNumber;
        $code = SMSController::generateVerificationCode();
        $sms->verification_code = $code;
        $sms->purpose = SMSController::PASSWORD_REMINDER;
        $sms->save();

        SMSController::sendSMS($mobileNumber, '请输入该验证码以找回密码：' . $code);

    }


    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token))
            App::abort(404);

        return View::make('pages.password.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->reg_code = null;
            $user->save();
        });

        switch ($response) {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to('/');
        }
    }

    public function postResetMobile() {
        $mobileNumber = Input::get('mobile_number');

        if (!SMSController::verifyMobileCode($mobileNumber, Input::get('verification_code'), SMSController::PASSWORD_REMINDER)) {
            return Redirect::back()->with('error', '对不起,您输入的验证码有误，请重试');
        }

        $member = Member::where('mobile_number', '=', $mobileNumber)
            ->first();

        if (empty($member)){
            return Redirect::back()->with('error', '对不起，手机号码似乎不对，请再试试');
        } else {
            $member->password = Hash::make(Input::get('password'));
            $member->reg_code = null;
            $member->save();

            return Redirect::to('/');
        }
    }

}

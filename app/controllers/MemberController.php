<?php

/**
 * Description of MemberController
 *
 * @author Allen
 */
class MemberController extends BaseController {

    public function postLogin() {
        $email = Input::get('email');
        $password = Input::get('password');
        $rememberMe = Input::get('remember_me');
        if (Auth::attempt(array('email' => $email, 'password' => $password, 'reg_code' => null), $rememberMe)) {
            if (Request::ajax()) {
                return Response::json(array('isValidAccount' => 1));
            } else {
                return Redirect::intended('/');
            }
        } else {
            return Redirect::back()->with('error', '无法登陆，账号或密码不正确');
        }
    }

    public function getLogin() {
        if (Auth::check()) {
            return Redirect::to('/');
        } else {
            return View::make('pages.login');
        }
    }

    public function getSignUp() {
        $params['pageTitle'] = "注册成为目光之城会员";
        return View::make('pages.sign-up', $params);
    }

    public function postSignUp() {

        $validator = $this->validateSignUp();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        Input::flash();

        $nickname = Input::get('nickname');
        //check for reserved keywords
        if (hasReservedKeyword($nickname)) {
            return Redirect::back()->with('error', '对不起。请不要使用“管理员”，“目光之城”等关键字注册');
        }

        $email = Input::get('email');
        $password = Input::get('password');
        $confirmPassword = Input::get('confirm_password');

        if (Input::has('ambassador_code')) {
            if (!AmbassadorController::isAmbassadorCodeValid(Input::get('ambassador_code'))) {
                return Redirect::back()->with('error', '邀请码不存在，请重新输入');
            }
        }

        if ($password !== $confirmPassword) {
            return Redirect::back()->with('error', '两次输入的密码不符合');
        }

        if (Member::where('email', '=', $email)->count() > 0) {
            return Redirect::back()->with('error', '此邮箱已经被注册');
        }
        $member = new Member;
        $member->nickname = $nickname;
        $member->email = $email;
        $member->password = Hash::make($password);
        $member->reg_code = $this->generateGUID();

        //create ambassador relationship
        if (Input::has('ambassador_code')) {
            $member->invited_by = AmbassadorController::findAmbassadorRelation(Input::get('ambassador_code'));
        }

        $member->save();
        Session::put('memberRegistered', $member->member_id);

        //send email
        $data['email'] = $email;
        $data['link'] = action('MemberController@verifyRegistration', array($email, $member->reg_code));
        Mail::queue('emails.auth.verify-registration', $data, function($message) {
            $nickname = Input::get('nickname');
            $email = Input::get('email');
            $message->to($email, $nickname)->subject('请验证注册信息');
        });

        return View::make('pages.verify-registration', array('email' => $email));
    }

    public function getResendVerifyEmail() {
        $member = Member::findOrFail(Session::get('memberRegistered'));
        //send email
        $data['email'] = $member->email;
        $data['nickname'] = $member->nickname;
        $data['link'] = action('MemberController@verifyRegistration', array($member->email, $member->reg_code));
        Mail::queue('emails.auth.verify-registration', $data, function($message) use ($member) {
            $nickname = $member->nickname;
            $email = $member->email;
            $message->to($email, $nickname)->subject('请验证注册信息');
        });
        return View::make('pages.verify-registration', array('email' => $member->email))->with('status', '邮件发送成功，请查收');
    }

    public function verifyRegistration($email, $comCode) {
        $member = Member::where('email', '=', $email)->firstOrFail();
        $params = array();
        if ($member->reg_code == $comCode) {
            $params['isSuccessful'] = true;
            $member->reg_code = null;
            $member->save();
            Auth::loginUsingId($member->member_id); //login this user
            Session::forget('memberRegistered');
        } else {
            $params['isSuccessful'] = false;
        }
        return View::make('pages.verify-registration-result', $params);
    }

    public function getLogout() {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }

    private function generateGUID() {
        return md5(uniqid(rand()));
    }

    private function validateSignUp() {
        $rules = array(
            'nickname' => 'required|max:20',
            'email' => 'required|max:50',
            'password' => 'required|min:6|max:16|alpha_num'
        );
        return Validator::make(Input::all(), $rules);
    }



}

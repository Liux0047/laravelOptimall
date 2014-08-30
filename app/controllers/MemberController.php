<?php

/**
 * Description of MemberController
 *
 * @author Allen
 */
class MemberController extends BaseController {

    public function login() {        
        $email = Input::get('email');
        $password = Input::get('password');
        $rememberMe = Input::get('remember_me');
        if (Auth::attempt(array('email' => $email, 'password' => $password, 'com_code' => null), $rememberMe)) {            
            if (Request::ajax()){
                return Response::json(array('isValidAccount' => 1));                
            }
            else {
                return Redirect::intended('/');
            }
            
        }
    }
    
    public function showLoginPage() {
        return View::make('pages.login');
    }

    public function signUp() {
        $params['pageTitle'] = "注册成为目光之城会员";
        return View::make('pages.sign-up', $params);
    }

    public function processSignUp() {
        $nickname = Input::get('nickname');
        $email = Input::get('email');
        $password = Input::get('password');
        $confirmPassword = Input::get('confirm_password');

        if ($password !== $confirmPassword) {
            return Redirect::to('sign-up')->with('message', ' 两次输入的密码不符合');
        }
        $member = new Member;
        $member->nickname = $nickname;
        $member->email = $email;
        $member->password = Hash::make($password);
        $member->com_code = $this->generateGUID();
        $member->save();

        //send email
        $data['email'] = $email;
        $data['link'] = URL::to('sign-up/verify'.'/'.$email.'/'.$member->com_code);
        Mail::queue('emails.auth.verify-registration', $data, function($message) {
            $nickname = Input::get('nickname');
            $email = Input::get('email');
            $message->to($email, $nickname)->subject('请验证注册信息');
        });
        
        return View::make('pages.verify-registration', array('email' => $email));
    }

    public function verifyRegistration($email, $comCode) {
        $member = Member::where('email', '=', $email)->firstOrFail();
        $params = array();
        if ($member->com_code == $comCode) {
            $member->com_code = null;
            $member->save();
            $params['isSuccessful'] = true;
        }
        else {
            $params['isSuccessful'] = false;
        }        
        return View::make('pages.verify-registration-result', $params);
    }
    
    public function logout () {
        Auth::logout();
        return Redirect::to('/');
    }
    
    private function generateGUID() {
        return md5(uniqid(rand()));
    }

}

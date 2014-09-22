<?php

/**
 * Description of AdminController
 *
 * @author Allen
 */
class AdminController extends BaseController {
    
    Const MAX_LOGIN_ATTEMPTS = 10;

    public function getLogin() {
        if (Session::has('admin')) {
            return Redirect::action('AdminFunctionController@getIndex');
        } else {
            return View::make('pages.admin.login');
        }
    }

    public function postLogin() {
        $validator = $this->validateLogin();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $admin = Admin::where('username', '=', Input::get('username'))->first();
        if (!isset($admin)) {
            return Redirect::back()->with('error', '账号或者密码不对');
        } else {
            if (Hash::check(Input::get('password'), $admin->password)) {
                // if login successful
                Session::put('admin.username', $admin->username);
                Session::put('admin.priviledge', $admin->priviledge);
                $admin->login_attempts = 0; //clear the attempt marker
                return Redirect::intended('admin-dashboard');
            } else if ($admin->login_attempts < self::MAX_LOGIN_ATTEMPTS){
                $admin->login_attempts += 1;
                $admin->save();
                return Redirect::back()->with('error', '账号或者密码不对');
            } else {
                return Redirect::back()->with('error', '对不起，改账号已经被锁定');
            }
        }
    }

    public function getCreateAdmin($code) {
        return Hash::make($code);
    }

    public function getLogout() {
        Session::forget('admin');
        return Redirect::to('/');
    }

    public static function isLoggedIn() {
        return Session::has('admin');
    }

    private function validateLogin() {
        $rules = array(
            'username' => 'required|max:20|alpha_num',
            'password' => 'required|min:5|max:20|alpha_num'
        );
        return Validator::make(Input::all(), $rules);
    }

}

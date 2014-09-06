<?php

/**
 * Description of AdminController
 *
 * @author Allen
 */
class AdminController extends BaseController {

    public function getLogin() {
        return View::make('pages.admin.login');
    }

    public function postLogin() {
        $validator = $this->validateLogin();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $admin = Admin::where('username', '=', Input::get('username'))->first();
        if (!isset($admin)){
            return Redirect::back()->with('error','账号或者密码不对');
        }
        if (Hash::check(Input::get('password'), $admin->password)){            
            Session::put('admin.username',$admin->username);
            Session::put('admin.priviledge',$admin->priviledge);
            return Redirect::intended('admin-dashboard');
        }
        else {
            return Redirect::back()->with('error','账号或者密码不对');
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

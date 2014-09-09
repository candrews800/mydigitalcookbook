<?php

class AuthController extends BaseController {

    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $remember_me = false;

        if(Input::get('remember_me') == true){
            $remember_me = true;
        }

        if (Auth::attempt(array('username' => $username, 'password' => $password), $remember_me)){
            return Redirect::back();
        }
        else{
            Session::flash('login_error', 'true');
            return Redirect::back()->withInput(Input::except('password'));
        }


    }

    public function logout(){
        Auth::logout();
        return Redirect::back();
    }

}

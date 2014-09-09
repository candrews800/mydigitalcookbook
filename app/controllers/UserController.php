<?php

class UserController extends BaseController {

    public function register(){
        $input = Input::all();

        $validator = Validator::make(
            $input,
            array(
                'username' => 'required|unique:users,username|min:3|max:30',
                'email' => 'email',
                'password' => 'required|min:6|max:30',
                'verify_password' => 'required|same:password'
            )
        );

        if ($validator->fails())
        {
            // The given data did not pass validation
            return Redirect::back()->withErrors($validator, 'register')->withInput(Input::except(array('password', 'verify_password')));
        }
        else{
            $user = new User();

            $user->username = $input['username'];
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);

            $user->save();

            Auth::login($user, true);

            return Redirect::to('/');
        }
    }

}

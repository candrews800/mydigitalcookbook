<?php $page = 'login'; ?>
@include('layout.header')

<div class="row">
    <div class="col-xs-12 col-md-6">
        {{ Form::open(array('url' => URL::to('/users/login'), 'id' => 'login-form', 'class' => 'clearfix')) }}
            <h2>Login</h2>

            @if(Session::has('error'))
            <div class="col-sm-8 col-sm-offset-4">
                <p>{{ Session::get('error') }}</p>
            </div>
            @endif

            @if(Session::has('notice'))
            <div class="col-sm-12">
                <p>{{ Session::get('notice') }}</p>
            </div>
            @endif

            <div class="form-group clearfix">
                <label for="register-username" class="col-sm-4 control-label">Username</label>
                <div class="col-sm-8">
                    {{ Form::text('username', null, array('id' => 'register-username', 'placeholder' => 'Username')) }}
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="register-password" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                    {{ Form::password('password', array('id' => 'register-password', 'placeholder' => 'Password', 'required' => 'required')) }}
                </div>
            </div>

            <div class="col-sm-8 col-sm-offset-4">
                <p id="password-reset"><a href="{{ url('users/forgot_password') }}">(forgot your password?)</a></p>
            </div>

            <div class="form-group clearfix">
                <div class="col-sm-8 col-sm-offset-4">
                    <input type="hidden" name="remember" value="0">
                    {{ Form::checkbox('remember', '1', null, array('id' => 'remember_me')) }}
                    <label for="remember_me">Remember me</label>
                </div>
            </div>


            <div class="form-group clearfix">
                <div class="col-sm-12">
                    {{ Form::submit('Sign In', array('class' => 'button pull-right')) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
    <div class="col-xs-12 col-md-6">
        {{ Form::open(array('url' => URL::to('users'), 'id' => 'register-form', 'class' => 'clearfix')) }}
            <h2>Register </h2>

            <div class="form-group clearfix">
                @if($errors->register->has('username'))
                <p class="col-sm-8 col-sm-offset-4 register-error">{{ $errors->register->first('username') }}</p>
                @endif
                <label for="register-username" class="col-sm-4 control-label">Username</label>
                <div class="col-sm-8">
                    {{ Form::text('username', null, array('id' => 'register-username', 'placeholder' => 'Username')) }}
                </div>
            </div>
            <div class="form-group clearfix">
                @if($errors->register->has('email'))
                <p class="col-sm-8 col-sm-offset-4 register-error">{{ $errors->register->first('email') }}</p>
                @endif
                <label for="register-email" class="col-sm-4 control-label">Email (optional)</label>
                <div class="col-sm-8">
                    {{ Form::email('email', null, array('id' => 'register-email', 'placeholder' => 'Email')) }}
                </div>
            </div>
            <div class="form-group clearfix">
                @if($errors->register->has('password'))
                <p class="col-sm-8 col-sm-offset-4 register-error">{{ $errors->register->first('password') }}</p>
                @endif
                <label for="register-password" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                    {{ Form::password('password', array('id' => 'register-password', 'placeholder' => 'Password')) }}
                </div>
            </div>
            <div class="form-group clearfix">
                @if($errors->register->has('password_confirmation'))
                <p class="col-sm-8 col-sm-offset-4 register-error">{{ $errors->register->first('password_confirmation') }}</p>
                @endif
                <label for="register-verify_password" class="col-sm-4 control-label">Verify Password</label>
                <div class="col-sm-8">
                    {{ Form::password('password_confirmation', array('id' => 'register-verify_password', 'placeholder' => 'Verify Password')) }}
                </div>
            </div>
            <div class="col-sm-12">
                {{ Form::submit('Sign Up', array('class' => 'button pull-right')) }}
            </div>
        {{ Form::close() }}
    </div>
</div>

@include('layout.footer')
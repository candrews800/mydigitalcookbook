<?php $page = 'login'; ?>
@include('layout.header_new')

<div class="row">
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
        <div class="col-sm-2 col-sm-offset-9">
            {{ Form::submit('Sign In', array('class' => 'button')) }}
        </div>
    </div>


{{ Form::close() }}
</div>

@include('layout.footer_new')
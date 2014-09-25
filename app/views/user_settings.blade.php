<?php $page = 'user_settings'; ?>
@include('layout.header')

<div class="row" id="settings">
    <h2>Account Settings</h2>

    <div id="settings-form">

        {{ Form::open(array('url' => URL::to('/users/settings'), 'class' => 'clearfix')) }}

        <div class="col-sm-8 col-sm-offset-4">
            <h3>Change Account Settings</h3>
        </div>

        @if($errors->changeSettings->has('username'))
        <div class="col-sm-8 col-sm-offset-4">
            <p>{{ $errors->changeSettings->first('username'); }}</p>
        </div>
        @endif

        @if(Session::has('settings_password_error'))
            <div class="col-sm-8 col-sm-offset-4">
                <p>Password entered does not match current password.</p>
            </div>
        @endif

        <div class="form-group clearfix">
            <label for="settings-username" class="col-sm-4 control-label">Username</label>
            <div class="col-sm-8">
                {{ Form::text('username', $user->username, array('id' => 'settings-username', 'placeholder' => 'Username')) }}
            </div>
        </div>

        @if($errors->changeSettings->has('email'))
        <div class="col-sm-8 col-sm-offset-4">
            <p>{{ $errors->changeSettings->first('email'); }}</p>
        </div>
        @endif

        <div class="form-group clearfix">
            <label for="settings-email" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8">
                {{ Form::email('email', $user->email, array('id' => 'settings-email', 'placeholder' => 'Email')) }}
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="settings-password" class="col-sm-4 control-label">Current Password</label>
            <div class="col-sm-8">
                {{ Form::password('current_password', array('id' => 'settings-password', 'placeholder' => 'Current Password')) }}
            </div>
        </div>
        <div class="col-sm-12">
            {{ Form::submit('Change Settings', array('class' => 'button pull-right')) }}
        </div>


        {{ Form::close() }}
        <hr />

        {{ Form::open(array('url' => URL::to('/users/settings/password'), 'class' => 'clearfix')) }}

        <div class="col-sm-8 col-sm-offset-4">
            <h3>Change Password</h3>
        </div>

        @if($errors->changePassword->has('new_password'))
        <div class="col-sm-8 col-sm-offset-4">
            <p>{{ $errors->changePassword->first('new_password'); }}</p>
        </div>
        @endif

        @if(Session::has('change_password_error'))
            <div class="col-sm-8 col-sm-offset-4">
                <p>Password entered does not match current password.</p>
            </div>
        @endif

        @if(Session::has('password_match_error'))
        <div class="col-sm-8 col-sm-offset-4">
            <p>New Passwords do not match each other.</p>
        </div>
        @endif

        <div class="form-group clearfix">
            <label for="changepassword-oldpassword" class="col-sm-4 control-label">Old Password</label>
            <div class="col-sm-8">
                {{ Form::password('old_password', array('id' => 'changepassword-oldpassword', 'placeholder' => 'Old Password')) }}
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="changepassword-newpassword" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-8">
                {{ Form::password('new_password', array('id' => 'changepassword-newpassword', 'placeholder' => 'New Password')) }}
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="register-verify_password" class="col-sm-4 control-label">Verify New Password</label>
            <div class="col-sm-8">
                {{ Form::password('password_confirmation', array('id' => 'changepassword-verify_password', 'placeholder' => 'Verify New Password')) }}
            </div>
        </div>
        <div class="col-sm-12">
            {{ Form::submit('Change Password', array('class' => 'button pull-right')) }}
        </div>

        {{ Form::close() }}
    </div>

</div>

@include('layout.footer')
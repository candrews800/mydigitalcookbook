<?php $page = 'admin'; ?>
@include('layout.header_new')

<div class="row" id="settings">
    <h2>Account Settings</h2>

    <div id="settings-form">

        {{ Form::open(array('url' => URL::to('admin/users/'.$user->id), 'class' => 'clearfix')) }}

        <div class="col-sm-8 col-sm-offset-4">
            <h3>Change Account Settings</h3>
        </div>

        <div class="form-group clearfix">
            <label for="settings-username" class="col-sm-4 control-label">Username</label>
            <div class="col-sm-8">
                {{ Form::text('username', $user->username, array('id' => 'settings-username', 'placeholder' => 'Username')) }}
            </div>
        </div>

        <div class="form-group clearfix">
            <label for="settings-email" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8">
                {{ Form::email('email', $user->email, array('id' => 'settings-email', 'placeholder' => 'Email')) }}
            </div>
        </div>
        </div>
        <div class="col-sm-12">
            {{ Form::submit('Change Settings', array('class' => 'button pull-right')) }}
        </div>


        {{ Form::close() }}

    </div>

</div>

@include('layout.footer_new')
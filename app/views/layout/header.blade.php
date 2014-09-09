<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">

    <title>Recipes with the Andrews</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">MyDigitalCookbook <span class="glyphicon glyphicon-cutlery"></span></a>

        @if(Auth::guest())
            <button type="button" class="btn btn-warning navbar-btn navbar-right" style="margin-left: 20px" data-toggle="modal" data-target="#register">Register</button>

            <button type="button" class="btn btn-default navbar-btn navbar-right" data-toggle="modal" data-target="#signIn">Sign In</button>

            <!-- Register -->
            <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                {{ Form::open(array('url' => 'register', 'class' => 'form-horizontal')) }}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">New User Sign-Up</span></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('username', 'Username',  array('class' => 'col-sm-4 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('username', null, array('class' => 'form-control')) }}
                                    @if ($errors->register->has('username'))
                                        <span class="help-block">{{ $errors->register->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('email', 'Account Recovery Email (optional)',  array('class' => 'col-sm-4 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::email('email', null, array('class' => 'form-control')) }}
                                    @if ($errors->register->has('email'))
                                        <span class="help-block">{{ $errors->register->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('password', 'Password',  array('class' => 'col-sm-4 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::password('password', array('class' => 'form-control')) }}
                                    @if ($errors->register->has('password'))
                                        <span class="help-block">{{ $errors->register->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('verify_password', 'Verify Password',  array('class' => 'col-sm-4 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::password('verify_password', array('class' => 'form-control')) }}
                                    @if ($errors->register->has('verify_password'))
                                        <span class="help-block">{{ $errors->register->first('verify_password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Register" />
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            <!-- Sign In -->
            <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                {{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Sign In</span></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('username', 'Username',  array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
                                    @if (Session::has('login_error'))
                                        <span class="help-block">No Match Found for this Username/Password</span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group">
                                {{ Form::label('password', 'Password',  array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember_me" value="true" type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Sign In" />
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

        @else
            <p class="navbar-text navbar-right">Signed in as <a href="{{ url('logout') }} " class="navbar-link">{{ ucfirst(Auth::user()->username) }}</a></p>
        @endif

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>



<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            @include('layout.search')
        </div>

        <div class="col-xs-12 col-md-2">
            @if(! Auth::guest() )
                @include('layout.new_recipe')
            @endif
        </div>
    </div>
</div>
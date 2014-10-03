<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">

    <title>MyDigitalCookbook.com</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Base Site core CSS -->
    <link href="{{ url('css/base.css') }}" rel="stylesheet">

    @if(isset($page))
    <link href="{{ url('css/'.$page.'.css') }}" rel="stylesheet">
    @endif

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .container{
            padding-top: 25px;
            padding-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="container">

<header>
    <!-- Above Menu -->
    <div class="row">
        <div id="main-logo" class="col-xs-12 col-md-4 text-center">
            <a  href="{{ url('/') }}">
                <img src="{{ url('img/logo.png') }}" />
            </a>
        </div>
        <div class="col-xs-12 col-md-4">
            <!-- Search -->
            {{ Form::open(array('url' => 'search', 'id' => 'search-form')) }}
            {{ Form::submit(' ') }}
            <span>
                {{ Form::text('search_text', null, array('placeholder' => 'Search for Recipes...')) }}
            </span>
            {{ Form::close() }}
        </div>
    </div>

    <!-- Main Menu -->
    <div class="row">
        <div class="col-xs-12 clearfix">
            <nav id="main-menu">
                <ul id="left-menu">
                    <li @if($page == 'home') class="active" @endif><a href="{{ url('/') }}">Home</a></li>
                    <li class="dropdown">
                        <a id="recipe-dropdown" class="dropdown-toggle" data-toggle="dropdown" href="#" >Recipes <span class="caret"></span></a>
                        <ul id="recipe-menu" class="dropdown-menu" role="menu" aria-labelledby="recipe-dropdown">
                            <li><a href="{{ url('search/') }}">Browse all</a></li>
                            <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">Search Recipe Category</li>
                            <?php $tags = Tag::all(); ?>
                            @foreach($tags as $tag)
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('search/'.$tag->name) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li @if($page == 'cookbook') class="active" @endif><a href="{{ url('/cookbook') }}">My Cookbook</a></li>
                    <li @if($page == 'meal') class="active" @endif><a href="{{ url('/meal') }}">Meal Planner</a></li>
                </ul>

                @if( Auth::guest() )
                    <ul id="right-menu">
                        <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>


                        <div id="register" class="modal" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Register <small>New User Signup</small></h4>
                                    </div>
                                    <div class="modal-body row clearfix">
                                        <!--{{ Form::open(array('url' => 'register')) }}-->
                                        {{ Form::open(array('url' => URL::to('users'))) }}
                                            <div class="form-group">
                                                <label for="register-username" class="col-sm-4 control-label">Username</label>
                                                <div class="col-sm-8">
                                                    {{ Form::text('username', null, array('id' => 'register-username', 'placeholder' => 'Username')) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="register-email" class="col-sm-4 control-label">Email (optional)</label>
                                                <div class="col-sm-8">
                                                    {{ Form::email('email', null, array('id' => 'register-email', 'placeholder' => 'Email')) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="register-password" class="col-sm-4 control-label">Password</label>
                                                <div class="col-sm-8">
                                                    {{ Form::password('password', array('id' => 'register-password', 'placeholder' => 'Password')) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="register-verify_password" class="col-sm-4 control-label">Verify Password</label>
                                                <div class="col-sm-8">
                                                    {{ Form::password('password_confirmation', array('id' => 'register-verify_password', 'placeholder' => 'Verify Password')) }}
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                {{ Form::submit('Sign Up', array('class' => 'button pull-right')) }}
                                                <button class="button exit-button pull-right" data-dismiss="modal">Close</button>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <li id="signin">Sign In <span class="caret"></span>
                            {{ Form::open(array('url' => URL::to('/users/login'), 'id' => 'signin-form')) }}
                                {{ Form::text('username', null, array('placeholder' => 'Username')) }}
                                {{ Form::password('password', array('placeholder' => 'Password')) }}
                                <p id="password-reset"><a href="{{ url('users/forgot_password') }}">(forgot your password?)</a></p>
                                <input type="hidden" name="remember" value="0">
                                {{ Form::checkbox('remember', '1', null, array('id' => 'remember_me')) }}
                                <label for="remember_me">Remember me</label>
                                {{ Form::submit('Sign In', array('class' => 'button')) }}
                            {{ Form::close() }}
                        </li>
                    </ul>
                @else
                    <ul id="right-menu">
                        <li><a href="#" data-toggle="modal" data-target="#new-recipe">Create Recipe</a></li>

                        <div id="new-recipe" class="modal" tabindex="-1" role="dialog" aria-labelledby="new-recipe" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Create Recipe</h4>
                                    </div>

                                    <div class="modal-body row clearfix">
                                        {{ Form::open(array('url' => 'recipe/new', 'files' => true)) }}

                                        <div class="form-group">
                                            @if($errors->newRecipe->has('name'))
                                            <p class="col-sm-8 col-sm-offset-4 new-recipe-error">{{ $errors->newRecipe->first('name') }}</p>
                                            @endif
                                            <label for="newrecipe-name" class="col-sm-4">Name</label>
                                            <div class="col-sm-8">
                                                {{ Form::text('name', null, array('id' => 'newrecipe-name', 'placeholder' => 'Recipe Name')) }}
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            {{ Form::label('food_image', 'Food Image',  array('class' => 'col-sm-4')) }}
                                            <div class="col-sm-8">
                                                {{ Form::file('food_image') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="newrecipe-additionaltext" class="col-sm-4">Additional Text</label>
                                            <div class="col-sm-8">
                                                {{ Form::textarea('additional_text', null, array('id' => 'newrecipe-additionaltext', 'placeholder' => 'Additional Text')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="newrecipe-tags" class="col-sm-4">Add Related Tags</label>
                                            <div class="col-sm-8">
                                                <div class="row" id="newrecipe-tags">
                                                    <?php $tags = Tag::getAll(); ?>
                                                    @foreach($tags as $tag)
                                                    <div class="col-sm-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="tags" name="tags[]" value="{{ $tag->id }}" type="checkbox" /> {{ $tag->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('prep_time', 'Prep Time',  array('class' => 'col-sm-4')) }}
                                            <div class="col-sm-5">
                                                {{ Form::text('prep_time', null, array('id' => 'newrecipe-preptime', 'placeholder' => 'Ex: 1hr 40min')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('cook_time', 'Cook Time',  array('class' => 'col-sm-4')) }}
                                            <div class="col-sm-5">
                                                {{ Form::text('cook_time', null, array('id' => 'newrecipe-cooktime', 'placeholder' => 'Ex: 1hr 40min')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('total_time', 'Total Time',  array('class' => 'col-sm-4')) }}
                                            <div class="col-sm-5">
                                                {{ Form::text('total_time', null, array('id' => 'newrecipe-totaltime', 'placeholder' => 'Ex: 1hr 40min')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            @if($errors->newRecipe->has('url'))
                                                <p class="col-sm-8 col-sm-offset-4 new-recipe-error">{{ $errors->newRecipe->first('url') }}</p>
                                            @endif
                                            {{ Form::label('url', 'Related Url',  array('class' => 'col-sm-4')) }}
                                            <div class="col-sm-8">
                                                {{ Form::text('url', null, array('id' => 'newrecipe-url', 'placeholder' => 'http://link.to/recipe')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="newrecipe-ingredients" class="col-sm-4">Ingredients</label>
                                            <div class="col-sm-8">
                                                {{ Form::textarea('ingredients', null, array('id' => 'newrecipe-ingredients', 'placeholder' => 'Ingredients')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="newrecipe-directions" class="col-sm-4">Directions</label>
                                            <div class="col-sm-8">
                                                {{ Form::textarea('directions', null, array('id' => 'newrecipe-directions', 'placeholder' => 'Directions')) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            {{ Form::submit('Create Recipe', array('class' => 'button pull-right')) }}
                                            <button class="button exit-button pull-right" data-dismiss="modal">Close</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <li id="user-profile">Hello, {{ Auth::user()->username }} <span class="caret"></span>
                            <div id="user-settings">
                                <a id="change-settings" href="{{ url('users/settings') }}">Account Settings</a>
                                <a id="logout" href="{{ url('users/logout') }}" class="button">Logout</a>
                            </div>
                        </li>
                    </ul>
                @endif
        </nav>
    </div>
</div>

</header>
<?php $page = 'admin'; ?>

@include('layout.header')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ url('admin/users') }} ">All Users</a>
        <a href="{{ url('admin/recipes') }} ">All Recipes</a>
        <a href="{{ url('admin/tags') }} ">All Tags</a>
        <a href="{{ url('admin/frontpage') }} ">Front Page</a>
        <a href="{{ url('admin/popular_searches') }} ">Popular Searches</a>
    </div>
</div>

@include('layout.footer')
<?php $page = 'home'; ?>

@include('layout.header_new')

<div class="row">
    <!-- Featured Recipe -->
    <div class="col-xs-12 col-md-8">
        <div id="featured-recipe">
            <img src="{{ url('recipe_images/mexican-rice.png') }}" />
            <div id="featured-heading">
                <h5>DAILY FEATURED RECIPE</h5>
            </div>
            <div id="featured-detail">
                <h1>Restaurant Style Mexican Rice</h1>
                <p>Kick up your home mexican dishes with this killer mexican rice recipe that will have your family wanting more.</p>
            </div>
        </div>
    </div>

    <!-- Advertisement -->
    <div class="col-xs-12 col-md-4">
        <div id="large-ad" class="advertising-info">
            <div class="spanner"></div>
            <div class="info">advertisement</div>
            <div class="spanner"></div>

            <img src="#" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div id="popular-searches">
            <h3>Popular Searches</h3>
            <ul>
                <li>
                    <a href="#">
                        <img src="{{ url('recipe_images/asian-recipes.png') }}" /> <p>Asian Recipes</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('recipe_images/asian-recipes.png') }}" /> <p>Asian Recipes</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('recipe_images/asian-recipes.png') }}" /> <p>Asian Recipes</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('recipe_images/asian-recipes.png') }}" /> <p>Asian Recipes</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('recipe_images/asian-recipes.png') }}" /> <p>Asian Recipes</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ url('recipe_images/asian-recipes.png') }}" /> <p>Asian Recipes</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div id="top-recipes">
            <h3>Top Recipes</h3>
            <ul>
                <li class="clearfix">
                    <a href="#">
                        <img src="{{ url('recipe_images/chickenparm.png') }}" />
                        <h2>Chicken Parm</h2>
                        <p>1,349 subscribers</p>
                    </a>
                </li>
                <li class="clearfix">
                    <a href="#">
                        <img src="{{ url('recipe_images/chickenparm.png') }}" />
                        <h2>Chicken Parm</h2>
                        <p>1,349 subscribers</p>
                    </a>
                </li>
                <li class="clearfix">
                    <a href="#">
                        <img src="{{ url('recipe_images/chickenparm.png') }}" />
                        <h2>Chicken Parm</h2>
                        <p>1,349 subscribers</p>
                    </a>
                </li>
                <li class="clearfix">
                    <a href="#">
                        <img src="{{ url('recipe_images/chickenparm.png') }}" />
                        <h2>Chicken Parm</h2>
                        <p>1,349 subscribers</p>

                    </a>
                </li>
                <li class="clearfix">
                    <a href="#">
                        <img src="{{ url('recipe_images/chickenparm.png') }}" />
                        <h2>Chicken Parm</h2>
                        <p>1,349 subscribers</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@include('layout.footer_new')
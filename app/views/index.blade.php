<?php $page = 'home'; ?>

@include('layout.header')

<div class="row">
    <!-- Featured Recipe -->
    <div class="col-xs-12 col-md-8">
        <div id="featured-recipe">
            <div id="featured-image" style="background-image: url('{{ url($featured_recipe->food_image) }}');" ></div>
            <div id="featured-heading">
                <h5>DAILY FEATURED RECIPE</h5>
            </div>
            <div id="featured-detail">
                <h1>{{ $featured_recipe->name }}</h1>
                <p>{{ $featured_recipe->description }}</p>
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

@include('layout.footer')
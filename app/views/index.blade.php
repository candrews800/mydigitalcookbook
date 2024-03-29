<?php $page = 'home'; ?>

@include('layout.header')

<div class="row">
    <!-- Featured Recipe -->
    <div class="col-xs-12 col-md-8">
        <div id="featured-recipe">
            <a href="{{ url('recipe/'.$featured_recipe->id) }}" style="display: block; height: 100%;">
                <div id="featured-image" style="background-image: url('{{ url($featured_recipe->food_image) }}');" ></div>
                <div id="featured-heading">
                    <h5>DAILY FEATURED RECIPE</h5>
                </div>
                <div id="featured-detail">
                    <h1>{{ $featured_recipe->name }}</h1>
                    <p>{{ $featured_recipe->description }}</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Advertisement -->
    <div class="col-xs-12 col-md-4 hidden-xs hidden-sm">
        <div id="large-ad" class="advertising-info">
            <div class="info">advertisement</div>

            <img src="#" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div id="top-recipes">
            <h3>Top Recipes</h3>
            <ul>
                @foreach($top_recipes as $recipe)
                <a href="{{ url('recipe/'.$recipe->id) }}">
                    <li class="clearfix">
                            <div class="recipe-image" style="background-image: url('{{ url($recipe->food_image) }}');" ></div>
                            <h2>{{ $recipe->name }}</h2>
                            <p>{{ $recipe->subscriber_count }} subscribers</p>

                    </li>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div id="popular-searches">
            <h3>Popular Searches</h3>
            <ul>
                <div class="row">
                    @foreach($popular_searches as $entry)
                    <div class="col-xs-12 col-sm-6">
                        <li>
                            <a href="{{ url('/search/'.$entry->search_term) }}">
                                <img src="{{ url($entry->background_image) }}" /> <p>{{ $entry->name }}</p>
                            </a>
                        </li>
                    </div>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
</div>

@include('layout.footer')
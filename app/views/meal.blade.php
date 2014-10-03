<?php $page = 'meal'; ?>

@include('layout.header')

<div class="row">
    <!-- Search Results -->
    <div id="planner" class="col-xs-12 col-md-8">
        <h1>Meal Planner</h1>

        @if($recipes)
            <ul>
                <li>Recipe</li>
                @foreach($recipes as $recipe)
                    <li>
                        <a id="recipe-name" href="{{ url('recipe/'.$recipe->id) }}">{{ $recipe->name }}</a>
                        <a id="recipe-remove" href="{{ url('meal/remove/'.$recipe->id) }}">Remove</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No Recipes In Your Meal Planner!</p>
        @endif

        <a id="open-menu" href="{{ url('meal/open') }}" class="button">Open Meal Planner</a>
    </div>

    <!-- Advertisement -->
    <div class="col-xs-12 col-md-4 hidden-xs hidden-sm">
        <div id="large-ad" class="advertising-info">
            <div class="info">advertisement</div>

            <img src="#" />
        </div>
    </div>
</div>

@include('layout.footer')
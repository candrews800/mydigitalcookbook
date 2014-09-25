<?php $page = 'planner'; ?>

@include('layout.header_new')

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
                        <a id="recipe-remove" href="{{ url('menu/remove/'.$recipe->id) }}">Remove</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No Recipes In Your Menu!</p>
        @endif

        <a id="open-menu" href="{{ url('menu/open') }}" class="button">Open Menu</a>
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

@include('layout.footer_new')
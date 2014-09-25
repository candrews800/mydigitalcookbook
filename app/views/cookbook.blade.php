<?php $page = 'cookbook'; ?>

@include('layout.header_new')

<div class="row">
    <!-- Search Results -->
    <div id="cookbook" class="col-xs-12 col-md-8">
        <h1>My Cookbook</h1>

        @if(isset($recipes[0]))
        <ul>
            @foreach($recipes as $recipe)
            <li id="recipe-single" class="clearfix">
                <h2>
                    <a class="recipe-name" href="{{ url('recipe/'.$recipe->id) }}">{{ ucfirst($recipe->name) }}</a>
                </h2>
                <div id="img-bg">
                    <img src="{{ url($recipe->food_image) }}" />
                </div>
                <p id="recipe-tags">
                    @if($tags[$recipe->id][0] != null)
                        @foreach($tags[$recipe->id] as $tag)
                            <a href="{{ url('search/' . $tag->name) }}" class="tag">{{ $tag->name }}</a>
                        @endforeach
                    @endif
                </p>
                <div id="recipe-additional">
                    <div id="prep-time">
                        <h5>Prep Time</h5>
                        <p>{{ $recipe->cook_time }}</p>
                    </div>
                    <div id="cook-time">
                        <h5>Cook Time</h5>
                        <p>{{ $recipe->cook_time }}</p>
                    </div>
                    <div id="total-time">
                        <h5>Total Time</h5>
                        <p>{{ $recipe->total_time }}</p>
                    </div>
                    <div id="menu-addremove">
                        @if(Menu::containsRecipe($recipe->id))
                        <a href="{{ url('menu/remove/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-minus"></span> In Menu</a>
                        @else
                        <a href="{{ url('menu/add/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-plus"></span> Add To Menu</a>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

        @else
        <p>No items are currently in your cookbook. Search for recipes you are interested in and add them.</p>
        @endif
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
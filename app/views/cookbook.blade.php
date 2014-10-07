<?php $page = 'cookbook'; ?>

@include('layout.header')

<div class="row">
    <!-- Search Results -->
    <div id="cookbook" class="col-xs-12 col-md-8">
        <h1>My Cookbook</h1>

        @if(isset($recipes[0]))
        <ul>
            @foreach($recipes as $recipe)
            <li class="recipe-single clearfix">
                <div class="row">
                    <div class="col-xs-12 col-sm-push-8 col-sm-4">
                        <div id="img-bg">
                            <a href="{{ url('recipe/'.$recipe->id) }}"><img src="{{ url($recipe->food_image) }}" /></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-pull-4 col-sm-8 clearfix">
                        <h2>
                            <a class="recipe-name" href="{{ url('recipe/'.$recipe->id) }}">{{ ucfirst($recipe->name) }}</a>
                        </h2>
                        <p id="recipe-tags">
                            @if($tags[$recipe->id][0] != null)
                            @foreach($tags[$recipe->id] as $tag)
                            <a href="{{ url('search/' . $tag->name) }}" class="tag">{{ $tag->name }}</a>
                            @endforeach
                            @endif
                        </p>

                    </div>
                </div>
                <div id="menu-addremove">
                    @if(Meal::containsRecipe($recipe->id))
                    <a href="{{ url('meal/remove/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-minus"></span> In Meal</a>
                    @else
                    <a href="{{ url('meal/add/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-plus"></span> Add To Meal</a>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>

        @else
        <p>No items are currently in your cookbook. Search for recipes you are interested in and add them.</p>
        @endif
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
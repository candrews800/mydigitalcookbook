<?php $page = 'search'; ?>

@include('layout.header')

<div class="row">
    <!-- Search Results -->
    <div id="search-results" class="col-xs-12 col-md-8">
        <h1><span id="search-term">{{ $search_text }}</span> recipes</h1>

        @if(isset($recipes[0]))
        <ul>
            @foreach($recipes as $recipe)
            <div class="col-xs-12 col-md-6">
                <li style="background-image: url('{{ url($recipe->food_image) }}');">
                    <div class="recipe-background">
                        <h2>
                            <a class="recipe-name" href="{{ url('recipe/'.$recipe->id) }}">{{ ucfirst($recipe->name) }}</a>
                            <div class="tag-group">
                            @if($tags[$recipe->id][0] != null)
                            @foreach($tags[$recipe->id] as $tag)
                            <a href="{{ url('search/' . $tag->name) }}" class="tag">{{ $tag->name }}</a>
                            @endforeach
                            @endif
                            </div>
                        </h2>
                    </div>
                </li>
            </div>
            @endforeach
        </ul>

        @else
        <p>Sorry, no results found.</p>
        @endif

        <p>{{ $recipes->links(); }}</p>
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

@include('layout.footer')
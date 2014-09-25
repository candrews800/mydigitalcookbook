<?php $page = 'search'; ?>

@include('layout.header')

<div class="row">
    <!-- Search Results -->
    <div id="search-results" class="col-xs-12 col-md-8">
        <h1>Search results for: <span id="search-term">{{ $search_text }}</span> recipes</h1>

        @if(isset($recipes[0]))
        <ul>
            @foreach($recipes as $recipe)
            <li>
                <h2>
                    <a class="recipe-name" href="{{ url('recipe/'.$recipe->id) }}">{{ ucfirst($recipe->name) }}</a>
                    @if($tags[$recipe->id][0] != null)
                    @foreach($tags[$recipe->id] as $tag)
                    <a href="{{ url('search/' . $tag->name) }}" class="tag">{{ $tag->name }}</a>
                    @endforeach
                    @endif
                </h2>
            </li>
            @endforeach
        </ul>

        @else
        <p>Sorry, no results found.</p>
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

@include('layout.footer')
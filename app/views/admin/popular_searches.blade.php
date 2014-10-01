<?php $page = 'admin'; ?>

@include('layout.header')

<div class="row">
    <div class="col-sm-12">

        <h1>Popular Searches</h1>
        @foreach($popular_searches as $recipe)
            <form action="{{ url('admin/popular_searches/'.$recipe->id) }}" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Display Name" value="{{ $recipe->name }}" />
                <input type="text" name="search_term" placeholder="Search Term" value="{{ $recipe->search_term }}" />
                <img src="{{ url($recipe->background_image) }}" style="max-height: 200px; width: auto;"/>
                <input type="file" name="background_image" />
                <input type="submit" />
            </form>
            <br />
        @endforeach
    </div>
</div>

@include('layout.footer')
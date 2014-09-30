<?php $page = 'admin'; ?>

@include('layout.header')

<div class="row">
    <div class="col-sm-12">
        <h1>
            Tags
        </h1>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Recipes with Tag</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->recipe_count }}</td>
                <td><a href="{{ url('admin/tags/'.$tag->id.'/delete') }}">Delete</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ url('admin/tags') }}" method="post">
            <input type="text" name="name" placeholder="Tag Name" />
            <input type="submit" value="Create Tag" class="btn btn-default" />
        </form>
    </div>
</div>

@include('layout.footer')
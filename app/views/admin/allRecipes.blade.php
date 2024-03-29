<?php $page = 'admin'; ?>

@include('layout.header')

<div class="row">
    <div class="col-sm-12">
        <h1>
            Recipes
        </h1>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Subscriber Count</th>
                <th>Private?</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            @foreach($recipes as $recipe)
            <tr>
                <td><a href="{{ url('admin/recipes/'.$recipe->id) }}">{{ $recipe->name }}</a></td>
                <td>{{ $recipe->subscriber_count }}</td>
                <td>{{ $recipe->private }}</td>
                <td><a href="{{ url('admin/recipes/'.$recipe->id . '/delete') }}">Delete Recipe</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <p>
            <?php echo $recipes->links(); ?>
        </p>
    </div>
</div>

@include('layout.footer')
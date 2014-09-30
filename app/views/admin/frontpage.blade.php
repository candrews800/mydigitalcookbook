<?php $page = 'admin'; ?>

@include('layout.header')

<div class="row">
    <div class="col-sm-12">
        <h1>
            Current Featured Recipe: <small><a href="{{ url('recipe/'.$featured_recipe->id) }}" target="_blank">{{ $featured_recipe->name }}</a></small>
        </h1>
        <form action="{{ url('admin/frontpage') }}" method="post">
            <textarea name="description">{{ $featured_recipe->description }}</textarea>
            <input type="submit" value="Edit Description" />
        </form>
        <h3>
            All Recipes
        </h3>
        <table class="table">
            <thead>
            <tr>
                <th>Recipe</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            @foreach($recipes as $recipe)
            <tr>
                <td><a href="{{ url('recipe/'.$recipe->id) }}" target="_blank">{{ $recipe->name }}</a></td>
                <td><a href="{{ url('admin/frontpage/changeFeatured/'.$recipe->id)}}" class="btn btn-default">Make Featured</a></td>
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
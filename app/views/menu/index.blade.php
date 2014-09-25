@include('layout.header')

<div class="container" style="margin-top: 20px">
    <div class="col-xs-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Recipe</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>

                @if($recipes)
                @foreach($recipes as $recipe)
                    <tr>
                        <td><a href="{{ url('recipe/'.$recipe->id) }}">{{ $recipe->name }}</a></td>
                        <td><a href="{{ url('menu/remove/'.$recipe->id) }}">Delete</a></td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td>No Recipes In Your Menu!</td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="col-xs-12">
        <a href="{{ url('menu/open') }}" class="btn btn-info">Open Menu</a>
    </div>
</div>



@include('layout.footer')

@if($errors->newRecipe->all())
<script>
    $('#newRecipe').modal('show');
</script>
@endif
@include('layout.header')



@if(!isset($recipes))
<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-xs-12">
            <h3>No Results for '{{ $search_text }}'</h3>
        </div>
    </div>
</div>
@else

<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-xs-12">
            <h3>Showing Results for '{{ $search_text }}'</h3>
        </div>
        <div class="col-xs-12">
            <div class="table-responsive">
                <table id="recipe-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tags</th>
                            <th class="col-xs-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($recipes as $recipe)
                    <tr style="cursor: pointer">

                        <td onclick="document.location = '{{ url('recipe/' . $recipe->id) }}';" >{{ $recipe->name }}</td>
                        <td>
                            @if($tags[$recipe->id][0] != null)
                            @foreach($tags[$recipe->id] as $tag)
                            <a href="{{ url('search/' . $tag->name) }}" class="label label-success">{{ $tag->name }}</a>
                            @endforeach
                            @endif
                        </td>

                        @if($recipe->has_recipe)
                            <td><a href="#" class="btn btn-warning pull-right" disabled="disabled"> <small>In Your Cookbook</small></a></td>
                        @else
                            <td><a href="{{ url('recipe/add/'.$recipe->id) }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> <small>Add To Cookbook</small></a></td>
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@include('layout.footer')

<script>
    $(document).ready(function()
        {
            $("#recipe-table").tablesorter({
                sortList: [[0,0]],
                headers: {
                    3: {
                        sorter: false
                    }
                }
            });

            @if($errors->newRecipe->all())
            $('#newRecipe').modal('show');
            @endif

            @if($errors->register->all())
            $('#register').modal('show');
            @endif
        }
    );
</script>

<style>
    table th{
        background-color: #EEE;
    }
    .header{
        cursor: pointer;
        background-repeat: no-repeat;
        background-position: center right;
    }

    .headerSortDown{
        background-image: url('{{ url('img/desc.gif') }}');
        background-color: #DDD;
    }

    .headerSortUp{
        background-image: url('{{ url('img/asc.gif') }}');
        background-color: #DDD;
    }

</style>
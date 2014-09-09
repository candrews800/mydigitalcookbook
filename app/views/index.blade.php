@include('layout.header')

@if(isset($recipes))
<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table id="recipe-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)
                            <tr onclick="document.location = '{{ url('recipe/' . $recipe->id) }}';" style="cursor: pointer">

                                    <td>{{ $recipe->name }}</td>
                                    <td>
                                        @if($tags[$recipe->id][0] != null)
                                            @foreach($tags[$recipe->id] as $tag)
                                                <a href="{{ url('search/' . $tag->name) }}" class="label label-success">{{ $tag->name }}</a>
                                            @endforeach
                                        @endif
                                    </td>
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
        background-image: url(img/desc.gif);
        background-color: #DDD;
    }

    .headerSortUp{
        background-image: url(img/asc.gif);
        background-color: #DDD;
    }

</style>
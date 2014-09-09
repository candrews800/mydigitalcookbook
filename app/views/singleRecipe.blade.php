@include('layout.header')



<div class="container" style="margin-top: 20px">
    <div class="row">
        <dl class="dl-horizontal">
            <dt> </dt>
            <dd><h1>{{ $recipe->name }}</h1></dd>
        </dl>
    <div class="row">
        <div class="col-md-12">
            @if($tags[$recipe->id][0] != null)
            <dl class="dl-horizontal">
                <dt>Tags:</dt>
                <dd>
                        @foreach($tags[$recipe->id] as $tag)
                            <span class="label label-success">{{ $tag->name }}</span>
                        @endforeach
                </dd>
            </dl>
            @endif
        </div>
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt>Additional Text:</dt>
                <dd>{{ nl2br($recipe->additional_text) }}</dd>
            </dl>
        </div>
        <div class="col-md-5">
            <dl class="dl-horizontal">
                <dt>Cook Time:</dt>
                <dd>{{ $recipe->cook_time }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Prep Time:</dt>
                <dd>{{ $recipe->prep_time }}</dd>
            </dl>
            @if($recipe->calories)
            <dl class="dl-horizontal">
                <dt>Calories:</dt>
                <dd>{{ $recipe->calories }}</dd>
            </dl>
            @endif
            @if($recipe->url)
                <dl class="dl-horizontal">
                    <dt>URL:</dt>
                    <dd><a href="{{ $recipe->url }}">{{ $recipe->url }}</a></dd>
                </dl>
            @endif
        </div>
        <div class="col-md-5">
            <div class="row">
            @if($recipe->recipe_image)
                <div class="col-xs-12">
                    <img src="{{ url($recipe->recipe_image) }}" class="img-responsive img-thumbnail" />
                </div>
            @endif
            @if($recipe->food_image)
            <div class="col-xs-12">
                <img src="{{ url($recipe->food_image) }}" class="img-responsive img-thumbnail" />
            </div>
            @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt>Ingredients:</dt>
                <dd>{{ nl2br($recipe->ingredients) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Directions:</dt>
                <dd>{{ nl2br($recipe->directions) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Comments:</dt>
                <dd>{{ nl2br($recipe->comments) }}</dd>
            </dl>

            @if( ! Auth::guest() )
                @if(Auth::user()->hasRecipe($recipe->id))
                <dl class="dl-horizontal">
                    <dt> </dt>
                    <dd><a href="{{ url('recipe/remove/' . $recipe->id) }}" class="btn btn-danger">Remove Recipe From My Cookbook</a></dd>
                </dl>
                @else
                <dl class="dl-horizontal">
                    <dt> </dt>
                    <dd><a href="{{ url('recipe/add/'.$recipe->id) }}" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> <small>Add To Cookbook</small></a></dd>
                </dl>
                @endif

                @if(Auth::id() == $recipe->owner_id)
                <dl class="dl-horizontal">
                    <dt> </dt>
                    <dd><a href="{{ url('recipe/' . $recipe->id . '/edit') }}" class="btn btn-default">Edit Recipe</a></dd>
                </dl>
                @endif
            @endif
        </div>
    </div>


</div>



@include('layout.footer')

@if($errors->newRecipe->all())
<script>
    $('#newRecipe').modal('show');
</script>
@endif
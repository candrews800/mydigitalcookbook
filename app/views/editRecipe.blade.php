@include('layout.header')

<div class="container" style="margin-top: 20px">
    <div class="row">
        {{ Form::open(array('url' => 'recipe/' . $recipe->id . '/edit', 'files' => true, 'class' => 'form-horizontal')) }}
            @if ($errors->editRecipe->has('name'))
                <div class="form-group has-error">
            @else
                <div class="form-group">
            @endif
                {{ Form::label('name', 'Name',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::text('name', $recipe->name, array('class' => 'form-control', 'placeholder' => 'Recipe Name')) }}
                    @if ($errors->editRecipe->has('name'))
                    <span class="help-block">{{ $errors->editRecipe->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('additional_text', 'Additional Text',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::textarea('additional_text', $recipe->additional_text, array('class' => 'form-control', 'placeholder' => 'Additional Text', 'rows' => 5)) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('tags', 'Tags',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-9">
                    <div class="row" style="max-height: 150px; overflow-y: auto;">
                        @foreach($tags as $tag)
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    <input id="tags" name="tags[]" value="{{ $tag->id }}" type="checkbox" <?php if($recipe->hasTag($tag->id)) echo 'checked'; ?> /> {{ $tag->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('prep_time', 'Prep Time',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('prep_time', $recipe->prep_time, array('class' => 'form-control', 'placeholder' => 'Ex: 1hr 40min')) }}
                </div>
                {{ Form::label('cook_time', 'Cook Time',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('cook_time', $recipe->cook_time, array('class' => 'form-control', 'placeholder' => 'Ex: 1hr 40min')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('calories', 'Calories',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('calories', $recipe->calories, array('class' => 'form-control', 'placeholder' => 'Ex: 750')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('recipe_image', 'Recipe Image',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::file('recipe_image') }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('food_image', 'Food Image',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::file('food_image') }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('url', 'URL',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::text('url', $recipe->url, array('class' => 'form-control', 'placeholder' => 'URL')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('ingredients', 'Ingredients',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::textarea('ingredients', $recipe->ingredients, array('class' => 'form-control', 'placeholder' => 'Ingredients', 'rows' => 5)) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('directions', 'Directions',  array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::textarea('directions', $recipe->directions, array('class' => 'form-control', 'placeholder' => 'Directions', 'rows' => 5)) }}
                </div>
            </div>

            <input type="submit" class="btn btn-primary pull-right" style="margin-left: 10px" value="Edit Recipe" />
            <a href="{{ url('recipe/' . $recipe->id) }}" class="btn btn-default pull-right">Cancel</a>


        {{ Form::close() }}
    </div>
</div>


@include('layout.footer')

<script>
    function deleteRecipe(){
        var r = confirm("Are you sure you want to delete this recipe?");
        if (r == true) {
            document.location = '{{ url('recipe/' . $recipe->id . '/delete') }}';
        }
    }
</script>
<?php
    $tags = Tag::all();
?>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#newRecipe">
    <span class="glyphicon glyphicon-plus"></span> <strong>New Recipe</strong>
</button>

<div class="modal" id="newRecipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{ Form::open(array('url' => 'recipe/new', 'files' => true, 'class' => 'form-horizontal')) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Recipe</h4>
            </div>
            <div class="modal-body">
                @if ($errors->newRecipe->has('name'))
                    <div class="form-group has-error">
                @else
                    <div class="form-group">
                @endif
                        {{ Form::label('name', 'Name',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Recipe Name')) }}
                            @if ($errors->newRecipe->has('name'))
                            <span class="help-block">{{ $errors->newRecipe->first('name') }}</span>
                            @endif
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
                                                <input id="tags" name="tags[]" value="{{ $tag->id }}" type="checkbox"> {{ $tag->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('additional_text', 'Additional Text',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('additional_text', null, array('class' => 'form-control', 'placeholder' => 'Additional Text', 'rows' => 5)) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('prep_time', 'Prep Time',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-4">
                            {{ Form::text('prep_time', null, array('class' => 'form-control', 'placeholder' => 'Ex: 1hr 40min')) }}
                        </div>
                        {{ Form::label('cook_time', 'Cook Time',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-4">
                            {{ Form::text('cook_time', null, array('class' => 'form-control', 'placeholder' => 'Ex: 1hr 40min')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('calories', 'Calories',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-4">
                            {{ Form::text('calories', null, array('class' => 'form-control', 'placeholder' => 'Ex: 750')) }}
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
                            {{ Form::text('url', null, array('class' => 'form-control', 'placeholder' => 'URL')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('ingredients', 'Ingredients',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('ingredients', null, array('class' => 'form-control', 'placeholder' => 'Ingredients', 'rows' => 5)) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('directions', 'Directions',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('directions', null, array('class' => 'form-control', 'placeholder' => 'Directions', 'rows' => 5)) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('comments', 'Comments',  array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('comments', null, array('class' => 'form-control', 'placeholder' => 'Comments/Suggestions/Ideas', 'rows' => 5)) }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create Recipe" />
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
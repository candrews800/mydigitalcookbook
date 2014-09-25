<?php $page = 'admin'; ?>

@include('layout.header')

<div class="row">
    {{ Form::open(array('url' => 'admin/recipes/' . $recipe->id, 'files' => true)) }}

    <div class="form-group clearfix">

        <label for="editrecipe-name" class="col-sm-4">Name</label>
        <div class="col-sm-8">
            {{ Form::text('name', $recipe->name, array('id' => 'editrecipe-name', 'placeholder' => 'Recipe Name')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        <img style="width: 200px; height: auto;" src="{{ url($recipe->food_image) }}"  />
        {{ Form::label('food_image', 'Food Image',  array('class' => 'col-sm-4')) }}
        <div class="col-sm-8">
            {{ Form::file('food_image') }}
        </div>
    </div>

    <div class="form-group clearfix">
        <label for="editrecipe-additionaltext" class="col-sm-4">Additional Text</label>
        <div class="col-sm-8">
            {{ Form::textarea('additional_text', $recipe->additional_text, array('id' => 'editrecipe-additionaltext', 'placeholder' => 'Additional Text')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        <label for="editrecipe-tags" class="col-sm-4">Edit Related Tags</label>
        <div class="col-sm-8">
            <div class="row" id="newrecipe-tags">
                <?php $tags = Tag::all(); ?>
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

    <div class="form-group clearfix">
        {{ Form::label('prep_time', 'Prep Time',  array('class' => 'col-sm-4')) }}
        <div class="col-sm-5">
            {{ Form::text('prep_time', $recipe->prep_time, array('id' => 'editrecipe-preptime', 'placeholder' => 'Ex: 1hr 40min')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        {{ Form::label('cook_time', 'Cook Time',  array('class' => 'col-sm-4')) }}
        <div class="col-sm-5">
            {{ Form::text('cook_time', $recipe->cook_time, array('id' => 'editrecipe-cooktime', 'placeholder' => 'Ex: 1hr 40min')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        {{ Form::label('total_time', 'Total Time',  array('class' => 'col-sm-4')) }}
        <div class="col-sm-5">
            {{ Form::text('total_time', null, array('id' => 'editrecipe-totaltime', 'placeholder' => 'Ex: 1hr 40min')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        @if($errors->editRecipe->has('url'))
        <p class="col-sm-8 col-sm-offset-4 new-recipe-error">{{ $errors->editRecipe->first('url') }}</p>
        @endif
        {{ Form::label('url', 'Related Url',  array('class' => 'col-sm-4')) }}
        <div class="col-sm-8">
            {{ Form::text('url', $recipe->url, array('id' => 'editrecipe-url', 'placeholder' => 'http://link.to/recipe')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        <label for="editrecipe-ingredients" class="col-sm-4">Additional Text</label>
        <div class="col-sm-8">
            {{ Form::textarea('ingredients', $recipe->ingredients, array('id' => 'editrecipe-ingredients', 'placeholder' => 'Ingredients')) }}
        </div>
    </div>

    <div class="form-group clearfix">
        <label for="editrecipe-directions" class="col-sm-4">Additional Text</label>
        <div class="col-sm-8">
            {{ Form::textarea('directions', $recipe->directions, array('id' => 'editrecipe-directions', 'placeholder' => 'Directions')) }}
        </div>
    </div>

    <div class="col-sm-12 clearfix">
        {{ Form::submit('Edit Recipe', array('class' => 'button pull-right')) }}
        <a href="{{ url('admin/recipes') }}" class="button exit-button pull-right" data-dismiss="modal">Cancel</a>
    </div>
    {{ Form::close() }}
</div>

@include('layout.footer')
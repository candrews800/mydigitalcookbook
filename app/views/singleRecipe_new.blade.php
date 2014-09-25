<?php $page = 'single'; ?>

@include('layout.header')

<div class="row">
    <!-- Search Results -->
    <div id="single-recipe" class="col-xs-12 col-md-8">


        <div id="recipe-infobox" class="clearfix">
            <h1>
                {{ ucfirst($recipe->name) }}
            </h1>
            <div id="recipe-image">
                @if($recipe->food_image)
                <img src="{{ url($recipe->food_image) }}" />
                @else
                <img src="recipes_images/no_img.png" />
                @endif
            </div>
            <div id="recipe-additional">
                <p>{{ nl2br($recipe->additional_text) }}</p>
                    @foreach($tags[$recipe->id] as $tag)
                        @if($tag)
                            <a href="{{ url('search/'.$tag->name) }}" class="tag">{{ $tag->name }}</a>
                        @endif
                    @endforeach

                </p>
                <div id="prep-time">
                    <h5>Prep Time</h5>
                    <p>{{ $recipe->prep_time }}</p>
                </div>
                <div id="cook-time">
                    <h5>Cook Time</h5>
                    <p>{{ $recipe->cook_time }}</p>
                </div>
                <div id="total-time">
                    <h5>Total Time</h5>
                    <p>{{ $recipe->total_time }}</p>
                </div>
            </div>
        </div>



        <div id="recipe-menubar" class="clearfix">
            <p id="cookbook-addremove">
                @if( ! Auth::guest() &&  Auth::user()->hasRecipe($recipe->id) )
                <a href="{{ url('recipe/remove/' . $recipe->id) }}" class="button"><span class="glyphicon glyphicon-minus"></span> In Cookbook</a>
                @else
                <a href="{{ url('recipe/add/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-plus"></span> Add To Cookbook</a>
                @endif
            </p>
            <p id="menu-addremove">
                @if(Meal::containsRecipe($recipe->id))
                    <a href="{{ url('meal/remove/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-minus"></span> In Meal</a>
                @else
                    <a href="{{ url('meal/add/'.$recipe->id) }}" class="button"><span class="glyphicon glyphicon-plus"></span> Add To Meal</a>
                @endif
            </p>
            @if(Auth::id() == $recipe->owner_id)
            <p id="recipe-edit">
                <a href="#" data-toggle="modal" data-target="#edit-recipe" class="button">Edit Recipe</a>
            </p>

            <div id="edit-recipe" class="modal" tabindex="-1" role="dialog" aria-labelledby="edit-recipe" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Edit Recipe</h4>
                        </div>

                        <div class="modal-body row clearfix">
                            {{ Form::open(array('url' => 'recipe/' . $recipe->id . '/edit', 'files' => true)) }}

                            <div class="form-group">
                                @if($errors->editRecipe->has('name'))
                                <p class="col-sm-8 col-sm-offset-4 edit-recipe-error">{{ $errors->editRecipe->first('name') }}</p>
                                @endif
                                <label for="editrecipe-name" class="col-sm-4">Name</label>
                                <div class="col-sm-8">
                                    {{ Form::text('name', $recipe->name, array('id' => 'editrecipe-name', 'placeholder' => 'Recipe Name')) }}
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                {{ Form::label('food_image', 'Food Image',  array('class' => 'col-sm-4')) }}
                                <div class="col-sm-8">
                                    {{ Form::file('food_image') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="editrecipe-additionaltext" class="col-sm-4">Additional Text</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('additional_text', $recipe->additional_text, array('id' => 'editrecipe-additionaltext', 'placeholder' => 'Additional Text')) }}
                                </div>
                            </div>

                            <div class="form-group">
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

                            <div class="form-group">
                                {{ Form::label('prep_time', 'Prep Time',  array('class' => 'col-sm-4')) }}
                                <div class="col-sm-5">
                                    {{ Form::text('prep_time', $recipe->prep_time, array('id' => 'editrecipe-preptime', 'placeholder' => 'Ex: 1hr 40min')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('cook_time', 'Cook Time',  array('class' => 'col-sm-4')) }}
                                <div class="col-sm-5">
                                    {{ Form::text('cook_time', $recipe->cook_time, array('id' => 'editrecipe-cooktime', 'placeholder' => 'Ex: 1hr 40min')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('total_time', 'Total Time',  array('class' => 'col-sm-4')) }}
                                <div class="col-sm-5">
                                    {{ Form::text('total_time', $recipe->total_time, array('id' => 'editrecipe-totaltime', 'placeholder' => 'Ex: 1hr 40min')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                @if($errors->editRecipe->has('url'))
                                    <p class="col-sm-8 col-sm-offset-4 new-recipe-error">{{ $errors->editRecipe->first('url') }}</p>
                                @endif
                                {{ Form::label('url', 'Related Url',  array('class' => 'col-sm-4')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('url', $recipe->url, array('id' => 'editrecipe-url', 'placeholder' => 'http://link.to/recipe')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="editrecipe-ingredients" class="col-sm-4">Additional Text</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('ingredients', $recipe->ingredients, array('id' => 'editrecipe-ingredients', 'placeholder' => 'Ingredients')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="editrecipe-directions" class="col-sm-4">Additional Text</label>
                                <div class="col-sm-8">
                                    {{ Form::textarea('directions', $recipe->directions, array('id' => 'editrecipe-directions', 'placeholder' => 'Directions')) }}
                                </div>
                            </div>

                            <div class="col-sm-12">
                                {{ Form::submit('Edit Recipe', array('class' => 'button pull-right')) }}
                                <button class="button exit-button pull-right" data-dismiss="modal">Close</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($recipe->url)
            <p id="recipe-source">
                <a href="{{ $recipe->url }}" target="_blank" class="button">Source</a>
            </p>
            @endif
        </div>

        <div id="recipe-ingredients">
            <h3>Ingredients</h3>
            <p>
                {{ nl2br($recipe->ingredients) }}
            </p>
        </div>

        <div id="recipe-directions">
            <h3>Directions</h3>
            <p>
                {{ nl2br($recipe->directions) }}
            </p>
        </div>

        @if( ! Auth::guest())
        <?php $note = Note::getRelated($recipe->id); ?>
        <div id="recipe-personalnote">
        @if($note->personal_note != "")
            <h3>Personal Notes</h3>
            <p>
                {{ nl2br($note->getText()) }} <br />
                <a id="personal-note-edit" href="#" data-toggle="modal" data-target="#personalNote">Edit</a>
            </p>

        @else

            <p id="add-note">Have something you do different? <a href="#" data-toggle="modal" data-target="#personalNote">Add a Personal Note</a>
        @endif

            <!-- Personal Note Modal-->
            {{ Form::open(array('url' => 'recipe/note/' . $recipe->id, 'class' => 'form-horizontal')) }}
            <div class="modal fade" id="personalNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content clearfix">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" >Personal Note <small>Do something different?</small></h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::textarea('personal_note', $note->getText(), array('class' => 'form-control', 'placeholder' => 'Personal Note')) }}

                            <input type="submit" class="button pull-right" value="Save" />
                            <button type="button" class="button exit-button pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        @endif
    </div>

    <!-- Advertisement -->
    <div class="col-xs-12 col-md-4">
        <div id="large-ad" class="advertising-info">
            <div class="spanner"></div>
            <div class="info">advertisement</div>
            <div class="spanner"></div>

            <img src="#" />
        </div>
    </div>
</div>

@include('layout.footer')
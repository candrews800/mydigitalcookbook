<?php $page = 'meal'; ?>

@include('layout.header')

<div class="row">
    <!-- Search Results -->
    <div id="single-recipe" class="col-xs-12 col-sm-8">
        <div id="meal-controls" class="row">
            <div class="col-xs-6 col-sm-6 pull-left">
                <a href="#" id="prevRecipe"><span class="glyphicon glyphicon-chevron-left"></span> <span class="text"></span></a>
            </div>
            <div class="col-xs-6 col-sm-6 pull-right">
                <a href="#" id="nextRecipe" class="pull-right"><span class="text"></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>

        <div id="recipe-infobox" class="row clearfix">
            <div class="col-xs-12 col-sm-5 col-sm-push-7">
                <div id="recipe-image">
                    @if($recipes[0]->food_image)
                    <img id="recipe-img-src" src="{{ url($recipes[0]->food_image) }}" />
                    @else
                    <img id="recipe-img-src" src="recipes_images/no_img.png" />
                    @endif
                </div>
            </div>

            <div class="col-xs-12 col-sm-7 col-sm-pull-5">
                <h1 id="recipe-name">
                    {{ ucfirst($recipes[0]->name) }}
                </h1>

                <div id="recipe-additional">
                    <p id="recipe-additionaltext">{{ nl2br($recipes[0]->additional_text) }}</p>
                    <div id="prep-time">
                        <h5>Prep Time</h5>
                        <p>{{ $recipes[0]->prep_time }}</p>
                    </div>
                    <div id="cook-time">
                        <h5>Cook Time</h5>
                        <p>{{ $recipes[0]->cook_time }}</p>
                    </div>
                    <div id="total-time">
                        <h5>Total Time</h5>
                        <p>{{ $recipes[0]->total_time }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="recipe-ingredients">
            <h3>Ingredients</h3>
            <p>
                {{ nl2br($recipes[0]->ingredients) }}
            </p>
        </div>

        <div id="recipe-directions">
            <h3>Directions</h3>
            <p>
                {{ nl2br($recipes[0]->directions) }}
            </p>
        </div>

        <?php $note = Note::getRelated($recipes[0]->id); ?>
        @if($note->getText())
        <div id="recipe-personalnote">
            <h3>Personal Notes</h3>
            <p>
                {{ nl2br($note->getText()) }}
            </p>
        </div>
        @endif
    </div>

    <!-- Advertisement -->
    <div class="col-xs-12 col-sm-4 hidden-xs hidden-sm">
        <div id="large-ad" class="advertising-info">
            <div class="info">advertisement</div>

            <img src="#" />
        </div>
    </div>
</div>

@include('layout.footer')
<script>
    <?php
        foreach($recipes as $recipe){
            if($recipe->food_image){
                $recipe->food_image = url($recipe->food_image);
            }
            else{
                $recipe->food_image = url('recipe_images/no_img.png');
            }
            if(! $recipe->personal_note){
                $recipe->personal_note = '';
            }
        }
    ?>

    var recipes = {{ $recipes->toJSON(); }};

    var current_recipe = 0;

    changeNextRecipeText(getNextRecipe(current_recipe));
    changePrevRecipeText(getPrevRecipe(current_recipe));

    $("#nextRecipe").click(function(){
        current_recipe = getNextRecipe(current_recipe);
        next = getNextRecipe(current_recipe);
        prev = getPrevRecipe(current_recipe);
        changeNextRecipeText(next);
        changePrevRecipeText(prev);
        changeRecipeText(current_recipe);
    });

    $("#prevRecipe").click(function(){
        current_recipe = getPrevRecipe(current_recipe);
        next = getNextRecipe(current_recipe);
        prev = getPrevRecipe(current_recipe);
        changeNextRecipeText(next);
        changePrevRecipeText(prev);
        changeRecipeText(current_recipe);
    });

    function changeNextRecipeText(i){
        $("#nextRecipe .text").text(recipes[i].name);
    }

    function changePrevRecipeText(i){
        $("#prevRecipe .text").text(recipes[i].name);
    }

    function changeRecipeText(i){
        $("#recipe-name").text(recipes[i].name);
        $("#recipe-additionaltext").text(recipes[i].additional_text);
        $("#prep-time p").text(recipes[i].prep_time);
        $("#cook-time p").text(recipes[i].cook_time);
        $("#total-time p").text(recipes[i].total_time);
        $("#recipe-ingredients p").html(recipes[i].ingredients.nl2br());
        $("#recipe-directions p").html(recipes[i].directions.nl2br());
        $("#recipe-img-src").attr("src", recipes[i].food_image);
        $("#recipe-personalnote p").html(recipes[i].personal_note.nl2br());
    }

    function getNextRecipe(current){
        if(current == recipes.length - 1){
            next = 0;
        }
        else{
            next = current + 1;
        }
        return next;
    }

    function getPrevRecipe(current){
        if(current == 0){
            prev = recipes.length - 1;
        }
        else{
            prev = current - 1;
        }
        return prev;
    }

    String.prototype.nl2br = function()
    {
        return this.replace(/\n/g, "<br />");
    }
</script>
@include('layout.header')

<div class="container menu">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a href="#" id="prevRecipe"><--</a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <a href="#" id="nextRecipe" class="pull-right">--></a>
                </div>
            </div>

            <dl id="name" class="dl-horizontal">
                <dt> </dt>
                <dd><h1>{{ $recipes[0]->name }}</h1></dd>
            </dl>
            <dl id="additional_text" class="dl-horizontal">
                <dt>Additional Text:</dt>
                <dd>{{ nl2br($recipes[0]->additional_text) }}</dd>
            </dl>
            <dl id="prep_time" class="dl-horizontal">
                <dt>Prep Time:</dt>
                <dd>{{ $recipes[0]->prep_time }}</dd>
            </dl>
            <dl id="cook_time" class="dl-horizontal">
                <dt>Cook Time:</dt>
                <dd>{{ $recipes[0]->cook_time }}</dd>
            </dl>

            <dl id="ingredients" class="dl-horizontal">
                <dt>Ingredients:</dt>
                <dd>{{ nl2br($recipes[0]->ingredients) }}</dd>
            </dl>
            <dl id="directions" class="dl-horizontal">
                <dt>Directions:</dt>
                <dd>{{ nl2br($recipes[0]->directions) }}</dd>
            </dl>

            <dl id="personal_note" class="dl-horizontal">
                <dt>Personal Notes:</dt>
                <dd>
                    @if($note = Note::getRelated($recipes[0]->id))
                        {{ nl2br($note->getText()) }}
                    @endif
                </dd>
            </dl>

        </div>
    </div>
</div>

@include('layout.footer')

<style>
    .menu{
        margin-top: 20px;
        margin-bottom: 20px;
    }

</style>

<script>
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
        $("#nextRecipe").text(recipes[i].name + " -->");
    }

    function changePrevRecipeText(i){
        $("#prevRecipe").text("<-- " + recipes[i].name);
    }

    function changeRecipeText(i){
        $("#name h1").text(recipes[i].name);
        $("#additional_text dd").text(recipes[i].additional_text);
        $("#prep_time dd").text(recipes[i].prep_time);
        $("#cook_time dd").text(recipes[i].cook_time);
        $("#ingredients dd").html(recipes[i].ingredients.nl2br());
        $("#directions dd").html(recipes[i].directions.nl2br());
        $("#personal_note dd").html(recipes[i].personal_note.nl2br());
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
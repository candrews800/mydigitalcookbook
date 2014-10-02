<?php

class CookbookController extends BaseController {

    public function displayCookbook(){
        if(Auth::guest()){
            return View::make('index');
        }
        $subscribed_recipes = Auth::user()->subscribed_recipes;

        $recipes = array();
        $tags = array();

        if($subscribed_recipes){
            $recipe_list = explode(' ', trim($subscribed_recipes));
            foreach($recipe_list as $recipe_id){
                $recipes[] = Recipe::find($recipe_id);
                if($recipes[count($recipes)-1]){
                    $tags[$recipe_id] = $recipes[count($recipes)-1]->getRelatedTags();
                }
                else{
                    array_pop($recipes);
                }
            }
        }

        return View::make('cookbook')->with(array('recipes' => $recipes, 'tags' => $tags));
    }

    public function displaySingleRecipe(Recipe $recipe){
        $tags[$recipe->id] = $recipe->getRelatedTags();

        return View::make('singleRecipe_new')->with(array('recipe' => $recipe, 'tags' => $tags));
    }

}

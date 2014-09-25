<?php

class MealController extends BaseController {

    public function addRecipe($recipe_id){
        Meal::addRecipe($recipe_id);

        return Redirect::back();
    }

    public function displayMeal(){
        $recipes = Recipe::whereIn('id', Meal::getRecipeList())->get();

        return View::make('meal')->with(array('recipes' => $recipes));
    }

    public function displayOpenMeal(){
        $recipes = Recipe::whereIn('id', Meal::getRecipeList())->get();

        return View::make('openMeal')->with(array('recipes' => $recipes));
    }

    public function removeRecipe($recipe_id){
        Meal::removeRecipe($recipe_id);

        return Redirect::back();
    }
}

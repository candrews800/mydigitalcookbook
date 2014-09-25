<?php

class MenuController extends BaseController {

    public function addRecipe($recipe_id){
        Menu::addRecipe($recipe_id);

        return Redirect::back();
    }

    public function displayMenu(){
        $recipes = Recipe::whereIn('id', Menu::getRecipeList())->get();

        return View::make('planner')->with(array('recipes' => $recipes));
    }

    public function displayOpenMenu(){
        $recipes = Recipe::whereIn('id', Menu::getRecipeList())->get();

        return View::make('openMeal')->with(array('recipes' => $recipes));
    }

    public function removeRecipe($recipe_id){
        Menu::removeRecipe($recipe_id);

        return Redirect::back();
    }
}

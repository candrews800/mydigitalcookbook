<?php

class HomeController extends BaseController {

    public function displayIndex(){
        $featured_recipe_db = DB::table('featured_recipe')->where('id', 1)->first();
        $featured_recipe = Recipe::find($featured_recipe_db->recipe_id);
        $featured_recipe->description = $featured_recipe_db->description;

        $top_recipes = Recipe::where('private', '!=', 't')->orderBy('subscriber_count', 'desc')->take(5)->get();

        $popular_searches = DB::table('popular_searches')->get();

        return View::make('index')->with(array('featured_recipe' => $featured_recipe, 'top_recipes' => $top_recipes, 'popular_searches' => $popular_searches));
    }
}

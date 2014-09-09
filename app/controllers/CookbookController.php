<?php

class CookbookController extends BaseController {

    public function displayAllRecipes(){
        if(Auth::guest()){
            return View::make('index');
        }
        $subscribed_recipes = Auth::user()->subscribed_recipes;

        $recipes = array();

        $recipe_list = explode(' ', $subscribed_recipes);
        foreach($recipe_list as $recipe_id){
            $recipes[] = Recipe::find($recipe_id);
            $tags[$recipe_id] = $recipes[count($recipes)-1]->getRelatedTags();
        }

        return View::make('index')->with(array('recipes' => $recipes, 'tags' => $tags));
    }

    public function displayEditRecipe($id){
        $recipe = Recipe::find($id);
        $tags = Tag::all();

        return View::make('editRecipe')->with(array('recipe' => $recipe, 'tags' => $tags));
    }

    public function displaySearchResults($search_text = null){
        if(! $search_text){
            return Redirect::to('/');
        }
        $search_tag = Tag::where('name', 'LIKE', '%'.$search_text.'%')->first();

        if($search_tag){
            $recipes = Recipe::where('name', 'LIKE', '%'.$search_text.'%')
                ->orWhere('related_tags', 'LIKE', '%'.$search_tag->id.'%')
                ->get();
        }
        else{
            $recipes = Recipe::where('name', 'LIKE', '%'.$search_text.'%')->get();
        }

        if(Auth::check()){
            foreach($recipes as $recipe){
                if(Auth::user()->hasRecipe($recipe->id)){
                    $recipe->has_recipe = true;
                }
            }
        }

        $tags = array();

        foreach($recipes as $recipe){
            $tags[$recipe->id] = $recipe->getRelatedTags();
        }

        return View::make('search')->with(array('search_text' => $search_text, 'recipes' => $recipes, 'tags' => $tags));
    }

    public function displaySingleRecipe($id){
        $recipe = Recipe::find($id);
        $tags[$recipe->id] = $recipe->getRelatedTags();

        return View::make('singleRecipe')->with(array('recipe' => $recipe, 'tags' => $tags));
    }

    public function redirectSearchResults(){
        $search_text = Input::get('search_text');

        return Redirect::to('search/' . $search_text);
    }

}

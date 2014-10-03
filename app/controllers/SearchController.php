<?php

class SearchController extends BaseController {

    public function displaySearchResults($search_text){
        $search_tag = Tag::where('name', 'LIKE', '%'.$search_text.'%')->first();

        if($search_tag){
            $recipes = Recipe::where('private', '!=', 't')
                ->where(function($query) use ($search_text, $search_tag)
                {
                    $query->where('name', 'LIKE', '%'.$search_text.'%')
                          ->orWhere('related_tags', 'LIKE', '%'.$search_tag->id.'%');
                })
                ->get();
        }
        else{
            $recipes = Recipe::where('name', 'LIKE', '%'.$search_text.'%')
                ->where('private', '!=', 't')
                ->get();
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

    public function redirectSearchResults(){
        $search_text = Input::get('search_text');

        return Redirect::to('search/' . $search_text);
    }

}

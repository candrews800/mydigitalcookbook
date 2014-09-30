<?php

class AdminController extends BaseController {

    public function index(){
        return View::make('admin.index');
    }

    public function displayAllUsers(){
        $users = User::paginate(15);

        return View::make('admin.allUsers')->with(array('users' => $users));
    }

    public function displayUser(User $user){
        return View::make('admin.singleUser')->with(array('user' => $user));
    }

    public function editUser(User $user){
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->save();

        return Redirect::back();
    }

    public function displayAllRecipes(){
        $recipes = Recipe::paginate(15);

        foreach($recipes as $recipe){
            $recipe->subscriber_count = DB::table('users')
                                            ->where('subscribed_recipes', 'REGEXP', '[[:<:]]'.$recipe->id.'[[:>:]]')
                                            ->count();
        }

        return View::make('admin.allRecipes')->with(array('recipes' => $recipes));
    }

    public function displayRecipe(Recipe $recipe){
        return View::make('admin.singleRecipe')->with(array('recipe' => $recipe));
    }

    public function editRecipe(Recipe $recipe){
        $recipe->edit(Input::all(), $admin = true);

        return Redirect::back();
    }

    public function displayAllTags(){
        $tags = Tag::all();
        foreach($tags as $tag){
            $tag->recipe_count = DB::table('recipes')
                                            ->where('related_tags', 'REGEXP', '[[:<:]]'.$tag->id.'[[:>:]]')
                                            ->count();
        }

        return View::make('admin.allTags')->with(array('tags' => $tags));
    }

    public function editTag(Tag $tag = null){
        if($tag == null){
            $tag = new Tag();
        }

        $tag->name = Input::get('name');
        $tag->save();

        return Redirect::back();
    }

    public function deleteTag(Tag $tag){
        $tag->delete();

        $recipes = Recipe::where('related_tags', 'REGEXP', '[[:<:]]'.$tag->id.'[[:>:]]')
                        ->get();

        foreach($recipes as $recipe){
            $recipe->removeTag($tag->id);
        }

        return Redirect::back();
    }
}

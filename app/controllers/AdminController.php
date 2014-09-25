<?php

class AdminController extends BaseController {

    public function index(){
        return View::make('admin.index');
    }

    public function displayAllUsers(){
        $users = User::paginate(15);

        return View::make('admin.allUsers')->with(array('users' => $users));
    }

    public function displayUser($id){
        $user = User::find($id);

        return View::make('admin.singleUser')->with(array('user' => $user));
    }

    public function editUser($id){
        $user = User::find($id);

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

    public function displayRecipe($id){
        $recipe = Recipe::find($id);

        return View::make('admin.singleRecipe')->with(array('recipe' => $recipe));
    }

    public function editRecipe($id){
        Recipe::edit(Input::all(), $id);

        return Redirect::back();
    }

}

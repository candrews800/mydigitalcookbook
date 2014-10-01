<?php

class RecipeController extends BaseController {

    public function addRecipeToUser(Recipe $recipe){
        Auth::user()->addRecipe($recipe->$id);
        $recipe->addSubscriber();
        return Redirect::back();
    }

    public function removeRecipeFromUser(Recipe $recipe){
        Auth::user()->removeRecipe($recipe->$id);
        $recipe->removeSubscriber();
        return Redirect::back();
    }

    public function saveRecipeNote(Recipe $recipe){
        $note = Note::getRelated($recipe->id);
        $note->user_id = Auth::id();
        $note->recipe_id = $recipe->id;
        $note->personal_note = Input::get('personal_note');

        // If there is only 'whitespace' then delete the note.
        if(preg_match('/^\s*$/', $note->personal_note)){
            $note->delete();
        }
        else{
            $note->save();
        }

        return Redirect::back();
    }

    public function saveRecipe(Recipe $recipe = null){
        $input = Input::all();
        $validator = Validator::make($input, Recipe::$rules);

        if ($validator->fails()){
            if($recipe == null){
                return Redirect::back()->withErrors($validator, 'newRecipe')->withInput();
            }
            return Redirect::back()->withErrors($validator, 'editRecipe')->withInput();
        }
        else{
            if($recipe){
                $recipe->edit($input);
            }
            else{
                $recipe = Recipe::make($input);
            }

            Auth::user()->addRecipe($recipe->id);

            return Redirect::to('recipe/' . $recipe->id)->with(array('recipe' => $recipe));
        }
    }


}
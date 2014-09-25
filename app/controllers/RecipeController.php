<?php

class RecipeController extends BaseController {

    public function addRecipeToUser($id = null){
        if($id == null){
            return Redirect::back();
        }

        Auth::user()->addRecipe($id);

        return Redirect::back();
    }

    public function editRecipeNote($id = null){
        if($id == null){
            return Redirect::back();
        }

        $note = Note::getRelated($id);
        if($note == null){
            $note = new Note();
            $note->user_id = Auth::id();
            $note->recipe_id = $id;
        }

        $note->personal_note = Input::get('personal_note');

        if(preg_match('/^\s*$/', $note->personal_note)){
            $note->delete();
        }
        else{
            $note->save();
        }

        return Redirect::back();
    }

    public function removeRecipeFromUser($id = null){
        if($id == null){
            return Redirect::back();
        }

        Auth::user()->removeRecipe($id);

        return Redirect::back();
    }

    public function saveRecipe($id = null){
        $input = Input::all();
        $rules = array(
            'name' => 'required',
            'calories' => 'integer',
            'url' => 'url',
            'food_image' => 'image'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            if($id == null){
                return Redirect::back()->withErrors($validator, 'newRecipe')->withInput(); # Return Errors to new Recipe Form
            }
            return Redirect::back()->withErrors($validator, 'editRecipe')->withInput(); # Return Errors to edit Recipe Form
        }
        else{
            $recipe = Recipe::edit($input, $id);

            Auth::user()->addRecipe($recipe->id);

            return Redirect::to('recipe/' . $recipe->id)->with(array('recipe' => $recipe));
        }
    }


}
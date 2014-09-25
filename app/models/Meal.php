<?php

class Meal extends Eloquent{

    public static function addRecipe($recipe_id){
        $meal = self::getRecipeText();

        if(! self::containsRecipe($recipe_id)){
            $meal .= ' ' . $recipe_id;

            Session::put('meal', trim($meal));
            Session::save();
        }
    }

    public static function removeRecipe($recipe_id){
        $meal = self::getRecipeText();
        $meal = preg_replace('/\b'.$recipe_id.'\b/',' ', $meal);
        $meal = preg_replace('/\s\s+/', ' ', $meal);
        Session::put('meal', trim($meal));
        Session::save();
    }

    public static function clearRecipes(){
        Session::forget('meal');
        Session::save();
    }

    public static function getRecipeText(){
        return Session::get('meal');
    }

    public static function getRecipeList(){
        return explode(' ', Session::get('meal'));
    }

    public static function containsRecipe($recipe_id){
        $meal = self::getRecipeText();

        return preg_match('/\b'.$recipe_id.'\b/', $meal);
    }
}

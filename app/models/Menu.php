<?php

class Menu extends Eloquent{

    public static function addRecipe($recipe_id){
        $menu = self::getRecipeText();

        if(! self::containsRecipe($recipe_id)){
            $menu .= ' ' . $recipe_id;

            Session::put('menu', trim($menu));
            Session::save();
        }
    }

    public static function removeRecipe($recipe_id){
        $menu = self::getRecipeText();
        $menu = preg_replace('/\b'.$recipe_id.'\b/',' ', $menu);
        $menu = preg_replace('/\s\s+/', ' ', $menu);
        Session::put('menu', trim($menu));
        Session::save();
    }

    public static function clearRecipes(){
        Session::forget('menu');
        Session::save();
    }

    public static function getRecipeText(){
        return Session::get('menu');
    }

    public static function getRecipeList(){
        return explode(' ', Session::get('menu'));
    }

    public static function containsRecipe($recipe_id){
        $menu = self::getRecipeText();

        return preg_match('/\b'.$recipe_id.'\b/', $menu);
    }
}

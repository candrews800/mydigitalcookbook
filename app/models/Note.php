<?php

class Note extends Eloquent{
    protected $table = 'notes';
    public $timestamps = false;

    public static function getRelated($recipe_id){
        if( ! Auth::check()){
            return false;
        }

        $note = self::where('user_id', '=', Auth::id())
                      ->where('recipe_id', '=', $recipe_id)
                      ->first();

        if($note == null){
            return false;
        }
        return $note;
    }

    public function getText(){
        return $this->personal_note;
    }
}

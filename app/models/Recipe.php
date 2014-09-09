<?php

class Recipe extends Eloquent{
    protected $table = 'recipes';

    public function addTag($tag_id){
        if($this->hasTag($tag_id)){
            return false;
        }
        else{
            $this->related_tags .= ' ' . $tag_id;
            $this->save();

            return true;
        }
    }

    public static function edit($input, $id = null){
        if( ! $id){
            $recipe = new self();
        }
        else{
            $recipe = self::find($id);
        }

        $recipe->name = $input['name'];
        $recipe->additional_text = $input['additional_text'];
        $recipe->prep_time = $input['prep_time'];
        $recipe->cook_time = $input['cook_time'];
        $recipe->calories = $input['calories'];
        $recipe->directions = $input['directions'];
        $recipe->url = $input['url'];
        $recipe->ingredients = $input['ingredients'];

        $recipe->owner_id = Auth::id();

        if( ! empty($input['tags'])){
            $recipe->related_tags = implode(' ', $input['tags']);
        }

        // File System
        if (Input::hasFile('food_image'))
        {
            $input['food_image']->move('recipe_images', Auth::user()->username . ' - ' . $input['name'] . '.' . $input['food_image']->getClientOriginalExtension());
            $recipe->food_image = 'recipe_images/' .  Auth::user()->username . ' - ' . $input['name'] . '.' . $input['food_image']->getClientOriginalExtension();
        }

        if (Input::hasFile('recipe_image'))
        {
            $input['recipe_image']->move('recipe_images', Auth::user()->username . ' - ' . $input['name'] . '.' . $input['recipe_image']->getClientOriginalExtension());
            $recipe->recipe_image = 'recipe_images/' .  Auth::user()->username . ' - ' . $input['name'] . '.' . $input['recipe_image']->getClientOriginalExtension();
        }

        $recipe->save();

        return $recipe;
    }

    public function getRelatedTags(){
        $tags = array();
        $tag_list = explode(' ', $this->related_tags);
        foreach($tag_list as $tag_id){
            $tags[] = Tag::find($tag_id);
        }
        return $tags;
    }

    public function hasTag($tag_id){
        $tag_list = $this->related_tags;

        return preg_match('/\b'.$tag_id.'\b/', $tag_list);
    }

    public function removeTag($tag_id){
        if( ! $this->hasTag($tag_id)){
            return false;
        }
        else{
            $this->related_tags = preg_replace('/\b'.$tag_id.'\b/', ' ', $this->related_tags);
            $this->related_tags = preg_replace('/\\s\\s+/', '', $this->related_tags);

            $this->save();

            return true;
        }
    }


}

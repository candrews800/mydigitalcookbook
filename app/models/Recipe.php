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

    public static function edit($input, $id = null, $admin = null){
        if( ! $id){
            $recipe = new self();
        }
        else{
            $recipe = self::find($id);
            if($recipe->hasChanges($input) && ! $recipe->hasSubscribers()){

                $old_recipe = $recipe;
                $old_recipe->private = 't';
                $recipe = new self();
            }
        }

        $recipe->name = $input['name'];
        $recipe->additional_text = $input['additional_text'];
        $recipe->prep_time = $input['prep_time'];
        $recipe->cook_time = $input['cook_time'];
        $recipe->directions = $input['directions'];
        $recipe->url = $input['url'];
        $recipe->ingredients = $input['ingredients'];

        $recipe->owner_id = Auth::id();

        if( ! empty($input['tags'])){
            $recipe->related_tags = implode(' ', $input['tags']);
        }

        if(isset($old_recipe)){
            $recipe->food_image = $old_recipe->food_image;
            $recipe->recipe_image = $old_recipe->recipe_image;
        }

        // File System
        if (Input::hasFile('food_image'))
        {
            $input['food_image']->move('recipe_images', Auth::user()->username . ' - ' . $input['name'] . '.' . $input['food_image']->getClientOriginalExtension());
            $recipe->food_image = 'recipe_images/' .  Auth::user()->username . ' - ' . $input['name'] . '.' . $input['food_image']->getClientOriginalExtension();
        }

        $recipe->save();
        if(isset($old_recipe) && ! $admin){
            $old_recipe->new_recipe_id = $recipe->id;
            $old_recipe->save();
            Auth::user()->removeRecipe($old_recipe->id);
        }

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

    public function hasChanges($input){
        $changes = false;

        if($this->name != $input['name']){
            $changes = true;
        }
        else if($this->prep_time != $input['prep_time']){
            $changes = true;
        }
        else if($this->cook_time != $input['cook_time']){
            $changes = true;
        }
        else if($this->directions != $input['directions']){
            $changes = true;
        }
        else if($this->url != $input['url']){
            $changes = true;
        }
        else if($this->ingredients != $input['ingredients']){
            $changes = true;
        }
        else if($this->food_image != $input['food_image'] && $input['food_image']){
            $changes = true;
        }

        return $changes;
    }

    public function hasSubscribers(){
        // Does a given recipe_id have subscribers besides the owner
        return DB::table('users')
            ->where('id', '!=', $this->owner_id)
            ->where('subscribed_recipes', 'REGEXP', '[[:<:]]'.$this->id.'[[:>:]]')
            ->count();
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

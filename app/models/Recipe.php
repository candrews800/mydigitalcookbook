<?php

class Recipe extends Eloquent{
    protected $table = 'recipes';
    public static $rules = array('name' =>          'required',
                                 'calories' =>      'integer',
                                 'url' =>           'url',
                                 'food_image' =>    'image');

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

    public static function make($input){
        $recipe = new self;
        return $recipe->edit($input);
    }

    public function edit($input, $admin = null){
        if( $this->id){
            if($this->hasChanges($input) && ! $this->hasSubscribers() && ! $admin){

                $old_recipe = $this;
                $old_recipe->private = 't';
                // Create new recipe
                unset($this->id);
                $this->food_image = $old_recipe->food_image;
            }
        }

        $this->name = $input['name'];
        $this->additional_text = $input['additional_text'];
        $this->prep_time = $input['prep_time'];
        $this->cook_time = $input['cook_time'];
        $this->total_time = $input['total_time'];
        $this->directions = $input['directions'];
        $this->url = $input['url'];
        $this->ingredients = $input['ingredients'];
        $this->owner_id = Auth::id();

        if( ! empty($input['tags'])){
            $this->related_tags = implode(' ', $input['tags']);
        }

        if (Input::hasFile('food_image'))
        {
            $input['food_image']->move('recipe_images', Auth::user()->username . ' - ' . $input['name'] . '.' . $input['food_image']->getClientOriginalExtension());
            $this->food_image = 'recipe_images/' .  Auth::user()->username . ' - ' . $input['name'] . '.' . $input['food_image']->getClientOriginalExtension();
        }

        $this->save();
        if(isset($old_recipe) && ! $admin){
            $old_recipe->new_recipe_id = $this->id;
            $old_recipe->save();
            Auth::user()->removeRecipe($old_recipe->id);
        }

        return $this;
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
        else if($this->total_time != $input['total_time']){
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

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
        $recipe->subscriber_count = 0;
        return $recipe->edit($input);
    }

    public function edit($input, $admin = null){
        $recipe = $this;
        if($recipe->id){
            if($recipe->hasChanges($input) && $recipe->hasSubscribers() && ! $admin){

                // Create new recipe
                $recipe = new self;
                $recipe->subscriber_count = 0;
                $recipe->food_image = $this->food_image; # Not every request has the image so this needs to be done here
                $recipe->save();

                // Update Previous Recipe with Attributes for new Recipe & Save
                $this->private = 't';
                $this->new_recipe_id = $recipe->id;
                $this->save();

                // Update all Previous Recipes that had a new_recipe_id that was $this and change to new $recipe id
                DB::table('recipes')->where('new_recipe_id', $this->id)->update(array('new_recipe_id' => $recipe->id));

                // Remove Previous Recipe from User & Take away from subscriber count
                if(Auth::user()->removeRecipe($this->id)){
                    $this->removeSubscriber();
                }
            }
        }

        $recipe->name = $input['name'];
        $recipe->additional_text = $input['additional_text'];
        $recipe->prep_time = $input['prep_time'];
        $recipe->cook_time = $input['cook_time'];
        $recipe->total_time = $input['total_time'];
        $recipe->directions = $input['directions'];
        $recipe->url = $input['url'];
        $recipe->ingredients = $input['ingredients'];
        $recipe->owner_id = Auth::id();

        if( ! empty($input['tags'])){
            $recipe->related_tags = implode(' ', $input['tags']);
        }

        if (Input::hasFile('food_image'))
        {
            $recipe->food_image = Image::store($input['food_image'], $input['name'], 'recipe_images');
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
        return $this->subscriber_count > 1;
    }

    public function addSubscriber(){
        $this->subscriber_count += 1;
        $this->save();
    }

    public function removeSubscriber(){
        $this->subscriber_count -= 1;
        $this->save();
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

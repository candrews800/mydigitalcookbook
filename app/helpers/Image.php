<?php

class Image{

    public static function store($image, $name, $directory){
        $image_name = self::getImageName($image, $name, $directory);
        $image->move($directory, $image_name);

        return 'recipe_images/' .  $image_name;;
    }

    public static function getImageName($image, $name, $directory){
        $image_name = $name . '.' . $image->getClientOriginalExtension();
        if(file_exists(public_path() . '/' . $directory . '/' . $image_name)){
            $valid = false;
            while( ! $valid){
                if(preg_match('/\((\d+)\)$/', $name, $num)){
                    $num[1]++;
                    $name = preg_replace('/\((\d+)\)$/', '(' . $num[1] . ')', $name);
                }
                else{
                    $name .= '(1)';
                }
                $image_name = $name . '.' . $image->getClientOriginalExtension();
                if( ! file_exists(public_path() . '/' . $directory . '/' . $image_name)){
                    $valid = true;
                }
            }
        }
        return $image_name;
    }
}
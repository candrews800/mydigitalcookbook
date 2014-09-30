<?php

class Tag extends Eloquent{
    protected $table = 'tags';
    public $timestamps = false;

    public static function getAll(){
        return self::all();
    }
}

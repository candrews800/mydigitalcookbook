<?php

class Tag extends Eloquent{
    protected $table = 'tags';

    public static function getAll(){
        return self::all();
    }
}

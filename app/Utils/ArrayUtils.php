<?php

namespace App\Utils;


class ArrayUtils
{
    public static function arrayExclude($array, Array $excludeKeys){
        foreach($excludeKeys as $key){
            unset($array[$key]);
        }
        return $array;
    }
}

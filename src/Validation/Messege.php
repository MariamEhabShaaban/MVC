<?php

namespace SecTheater\Validation;

class Messege{

    public static function generate($rule , $field){
        return str_replace('%s',$field,$rule);

    }
}
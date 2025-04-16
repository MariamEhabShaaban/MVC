<?php

namespace SecTheater\Validation\Rules;

use SecTheater\Validation\Rules\Contract\Rule;
require_once "Contract/Rule.php";
class BetweenRule implements Rule{
      
    protected int $max;

    protected int $min;

    public function __construct($min,$max){
        $this->min=$min;

        $this->max=$max;
    }

    public function apply($field, $value, $data){
        if(strlen($value)<$this->min){
            return false;
        }

        if(strlen($value)>$this->max){
            return false;
        }

        return true;

    }


    public function __tostring(){
        return "%s must be between {$this->min} and {$this->max} character";
    }



}
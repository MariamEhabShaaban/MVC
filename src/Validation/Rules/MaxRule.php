<?php

namespace SecTheater\Validation\Rules;

use SecTheater\Validation\Rules\Contract\Rule;
require_once "Contract/Rule.php";
class MaxRule implements Rule{
      
    protected int $max;

  
    public function __construct($max){
    
        $this->max=$max;
    }

    public function apply($field, $value, $data){
     
        if(strlen($value)>$this->max){
            return false;
        }

        return true;

    }


    public function __tostring(){
        return "%s must be less than {$this->max}";
    }



}
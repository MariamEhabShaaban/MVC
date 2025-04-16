<?php

namespace SecTheater\Validation;

use SecTheater\Validation\Rules\Contract\Rule;
require_once 'Rules/Contract/Rule.php';
class RequiredRule implements Rule{

    public function apply($field , $value , $data){
    
        return !empty($value);

    }

    public function __tostring(){
        return "%s is required and cannot be empty";

    }
}
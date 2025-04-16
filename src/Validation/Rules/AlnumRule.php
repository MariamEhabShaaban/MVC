<?php

namespace SecTheater\Validation\Rules;

use SecTheater\Validation\Rules\Contract\Rule;
require_once 'contract/Rule.php';
class AlnumRule implements Rule{

    public function apply($field, $value, $data){
        return preg_match('/^[a-zA-Z0-9]+$/',$value);
    }

    public function __tostring(){
        return "%s must be chars and numbers only";
    }

}
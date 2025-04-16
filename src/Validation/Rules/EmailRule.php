<?php


namespace SecTheater\Validation\Rules;

use SecTheater\Validation\Rules\Contract\Rule;
require_once "Contract/Rule.php";
class EmailRule implements Rule{


    public function apply($field, $value, $data){

        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $value);

    }

    public function __tostring(){
        
        return 'your %s address is not a valid email address';

    }

}
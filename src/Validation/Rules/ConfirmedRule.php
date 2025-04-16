<?php


namespace SecTheater\Validation\Rules;

use SecTheater\Validation\Rules\Contract\Rule;


require_once "Contract/Rule.php";

class ConfirmedRule implements Rule{


    public function apply($field, $value, $data){
        return ($data[$field]==$data[$field.'_confirmation']);

      

    }

    public function __tostring(){
        
       return "%s does not match %s confirmation";

    }




}
<?php


namespace SecTheater\Validation;

class ErrorBag{
    public array $errors=[];

    public function add($field,$messege){
      
        $this->errors[$field][]=$messege;

    }
}
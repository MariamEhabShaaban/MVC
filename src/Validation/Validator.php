<?php

namespace SecTheater\Validation;

use SecTheater\Validation\Resolver;
use SecTheater\Validation\ErrorBag;
use SecTheater\Validation\Messege;
use SecTheater\Validation\Rules\AlnumRule;
use SecTheater\Validation\Rules\BetweenRule;
use SecTheater\Validation\Rules\Contract\Rule;
use SecTheater\Validation\Rules\MaxRule;
use SecTheater\Validation\Rules\RuleMap;



require_once "RequiredRule.php";
require_once "Rules/AlnumRule.php";
require_once "Rules/MaxRule.php";
require_once "Rules/BetweenRule.php";
require_once "Rules/RuleMap.php";
require_once "ErrorBag.php";
require_once "Messege.php";
require_once "Resolver.php";
class Validator{


    protected array $data=[];

    protected array $rules=[];
    
    protected array $aliases=[];

    protected array $ruleMap=[
        'required' => RequiredRule::class,
        'alnum'=> AlnumRule::class,
        'max'=> MaxRule::class,
        'between'=>BetweenRule::class

    ];



    protected ErrorBag $errorBag;



    public function make ($data){
        $this->data=$data;
        $this->errorBag=new ErrorBag;
        $this->validate();
    }


    protected function validate(){

        foreach($this->rules as $field => $rules){
            foreach(Resolver::resolveRules($rules) as $rule){
               $this->applyRule($field, $rule);
            }
        }

    }




    protected function applyRule($field, Rule $rule){
        if(!$rule->apply($field, $this->getFieldValue($field),$this->data)){
            $this->errorBag->add($field, Messege::generate($rule,$this->alias($field)));
        }
    }

    public function getFieldValue($field){
        return $this->data[$field]??null;
    }

    public function setRules($rules){
        $this->rules=$rules;
    }

    public function passes(){
        return empty($this->errors());
    }

    public function errors($key=null){
        return $key ? $this->errorBag->errors[$key]:$this->errorBag->errors;
    }

    public function alias($field){
        return $this->aliases[$field]??$field;
    }

    public function setAliases(array $aliases){

        $this->aliases=$aliases;

    }




}
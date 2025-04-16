<?php

namespace SecTheater\Validation;

use Dotenv\Loader\Resolver as LoaderResolver;
use SecTheater\Validation\Rules\RuleMap;
require_once 'Rules/RuleMap.php';

trait Resolver{
    public static function resolveRules($rules){
        if (is_string($rules)) {
            $rules = str_contains($rules, '|') ? explode('|', $rules) : [$rules];
        }

        return array_map(function($rule){
            if(is_string($rule))return self::GetRuleFromString($rule);
             return $rule;

        },$rules) ;   
    }


    protected static function GetRuleFromString($rule){
        $exploded=explode(':',$rule);
        $rule=$exploded[0];
        $options=end($exploded);
       
        $options=explode(',',$options);
        var_dump(RuleMap::$Map[$rule]);
       
        return RuleMap::resolve($rule,$options);
    }
}
<?php

namespace SecTheater\Validation\Rules;

use SecTheater\Validation\Rules\AlnumRule;
use SecTheater\Validation\Rules\BetweenRule;
use SecTheater\Validation\Rules\Contract\Rule;
use SecTheater\Validation\Rules\MaxRule;
use SecTheater\Validation\RequiredRule;
use SecTheater\Validation\Rules\EmailRule;
use SecTheater\Validation\Rules\ConfirmedRule;
require_once "AlnumRule.php";
require_once "MaxRule.php";
require_once "BetweenRule.php";
require_once "EmailRule.php";
require_once "ConfirmedRule.php";

trait RuleMap{
    public static array $Map=[
        'required' => RequiredRule::class,
        'alnum'=> AlnumRule::class,
        'max'=> MaxRule::class,
        'between'=>BetweenRule::class,
        'email'=>EmailRule::class,
        'confirmed'=>ConfirmedRule::class
    ];


    public static function resolve($rule ,$options){
   
        $rule=static::$Map[$rule];
        return new $rule(...$options);
    }
}
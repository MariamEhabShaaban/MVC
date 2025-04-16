<?php


namespace SecTheater\Support;

class Hash{

    public static function password($password){
        return password_hash($password,PASSWORD_BCRYPT);
    }

    public static function verify($password, $hashed){
        return password_verify($password, $hashed);
    }

    public static function make($value){
        return sha1($value.time());
    }

}
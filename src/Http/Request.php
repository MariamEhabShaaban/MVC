<?php

namespace Sectheater\Mvc\Http;

class   Request{

    public function getMethod(){

        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getPath(){

        $path=$_SERVER["REQUEST_URI"]??'/';

        return str_contains($path,'?')?explode('?', $path)[0]:$path;
    }

}
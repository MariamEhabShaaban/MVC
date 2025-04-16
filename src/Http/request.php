<?php

namespace SecTheater\Http;



class Request{


    public function Method(){

        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function path(){
        $path=$_SERVER['REQUEST_URI'];
        return $path;
        

}
}
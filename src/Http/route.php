<?php


namespace SecTheater\Http;
use SecTheater\View\View;
class Route {

    protected Response $response;
    protected Request $request;
    
  
    public static array $routes=[];

    public function __construct(Request $request, Response $response){
        $this->request=$request;
        $this->response=$response;
    }

    public static function get($route,$action){

        self::$routes['get'][$route]=$action;

    }

    public static function post($route,$action){
        
        self::$routes['post'][$route]=$action;

    }

    public function resolve(){
        $path=$this->request->path();
        $method=$this->request->Method();
      
        $action=self::$routes[$method][$path]??false;

        if(!array_key_exists($path,self::$routes[$method])){

            View::makeError('404');

        }

      

        if(is_callable($action)){
            
            call_user_func_array($action,[]);
        }
        else if(is_array($action)){
           
            call_user_func_array([new $action[0],$action[1]],[]);
        }
    }



}
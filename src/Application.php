<?php


namespace SecTheater\Application;
use SecTheater\Http\Route;
use SecTheater\Http\Request;
use SecTheater\Http\Response;
use SecTheater\Support\Config;

class Application{
    protected Request $request;

    protected Response $response;

    protected Route $route;
    protected Config $config;


    public function __construct(){
       $this->request=new Request();
       $this->response=new Response();
       $this->route=new Route($this->request,$this->response);
       $this->config = new Config($this->loadConfigurations());

    }
    
    protected function loadConfigurations()
    {
        foreach(scandir(config_path()) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filename = explode('.', $file)[0];

            yield $filename => require config_path() . $file;
        }

    }


    public function run(){
        $this->route->resolve();

    }






}
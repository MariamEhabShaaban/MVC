<?php

namespace SecTheater\Support;

use ArrayAccess;
class Config implements \ArrayAccess{

    protected array $items=[];

    public function __construct($items){
        foreach($items as $key => $item){
            $this->items[$key]=$item;
        }
    }

    public function get($key , $default=null){
        if(is_array($key)){
            return $this->getMany($key);
        }

        return Arr::get($this->items,$key,$default);
    }
    public function offsetGet( $offset){
        return $this->get($offset);
    }


    public function offsetSet( $offset,$value){
        return $this->set($offset,$value);
    }

    public function offsetExists( $offset){
        return $this->exists($offset);
    }

    public function offsetUnset( $offset){
        return $this->set($offset,null);
    }

    public function getMany($keys){

        $config=[];

        foreach($keys as $key=>$default){
            if(is_numeric($key)){
                [$key,$default]=[$default,null];
            }
            $config[$key]=Arr::get($this->items, $keys, $default);
        }
        return $config;

    }

    public function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            Arr::set($this->items, $key, $value);
        }
    }

    public function push($key, $value)
    {
        $array = $this->get($key);

        $array[] = $value;

        $this->set($key, ...$array);
    }

    public function all()
    {
        return $this->items;
    }

    public function exists($key)
    {
        return Arr::exists($this->items, $key);
    }


   



};
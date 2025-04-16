<?php


namespace SecTheater\Support;

use ArrayAccess;

class Arr{

    public static function only ( $array , $key ){

        return array_intersect_key($array , array_flip((array) $key));

    }


    public static function accessable($value){

        return is_array($value) || $value instanceof ArrayAccess;

    }

    public static function exist($array , $key){

        if($array instanceof ArrayAccess ){

            return $array->offsetExists($key);

        }
        
        return array_key_exists($key,$array);

    }
  
    public static function has($array , $keys ){

        if(is_null($keys)){

            return false;

        }

        $keys = (array) $keys;


        foreach($keys as $key){

            $SubArray=$array;

            if(self::exist($array ,$key)){

                continue;

            }

            foreach(explode('.',$key) as $segment){
                if(self::accessable($segment) && self::exist($SubArray, $segment)){
                    $SubArray=$SubArray[$segment];
                }
                else{
                    return false;
                }
            }
        }

        return true;
    }

    public static function first($array, callable $callback = null, $default = null)
{
    if (is_null($callback)) {
        if (empty($array)) {
            return value($default);
        }
        foreach ($array as $item) {
            return $item;
        }
    }
    
    foreach ($array as $key => $value) {
        if (call_user_func($callback, $value, $key)) {
            return $value;
        }
    }
    
    return value($default);
}


    public static function last ($array , callable $callback = null , $default=null){

        if(is_null($callback)){
            return empty($array) ? value($default):end($array);
        }

        return self::first(array_reverse($array,true),$callback,$default);
    }


    public static function forget(&$array, $keys)
    {
        $original = &$array;

        $keys = (array) $keys;

        if (count($keys) === 0) {
            return;
        }

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (self::exist($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue ;
                }
            }

            unset($array[array_shift($parts)]);
           
        }
    }

    public static function except(&$array , $keys){
        return self::forget($array,$keys);
    }

    public static function flatten($array ,$depth=INF){
        $result=[];
        foreach($array as $item){
            if(!is_array($item)){
                $result[]=$item;
            }
            else if($depth==1){
                $result=array_merge($result,array_values($item));
            }
            else{
                $result=array_merge($result,self::flatten($item,$depth-1));
            }
        }
        return $result;
    }

    public static function get($array , $key , $default=null){
        if(!self::accessable($array)){
            return value($default);
        }

        if(is_null($key)){
            return $array;
        }

        if(self::exist($array,$key)){
            return $array[$key];
        }

        if(!str_contains($key,'.')){
            return $array[$key]??value($default);
        }

        if(str_contains($key,'.')){
            foreach(explode('.',$key ) as $segment ){
                if(self::exist($array,$segment) && self::accessable($array)){
                    $array=$array[$segment];
                }
                else{
                    return value($default); 
                }

            }
            return $array;
        }
    }

    public static function set (&$array , $key ,$value){
        
        if(is_null($key)){
            return array_push($array,$value);
        }

        $keys=explode('.',$key);
        $temp = &$array;
        while(count($keys)>1){
            $key=array_shift($keys);
            $temp=&$temp[$key];
        }
       
        $key =array_shift($keys);
        $temp[$key]=$value;
        return $array;


    }

    public static function unset(&$array ,  $key){
       return self::set($array , $key ,null);
    }

}
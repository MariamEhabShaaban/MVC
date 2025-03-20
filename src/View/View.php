<?php

namespace Sectheater\Mvc\View;

class View{

    public static function make ($view, $data = array()){
        $baseContent = self::getBaseContent();
      
         

         $viewContent = self::getViewContent($view,false,$data);


       return str_replace('{{content}}', $viewContent,$baseContent);

    }

    protected static function getBaseContent(){
      
         
        include view_path() . '/layouts/main.php';
       

      
      
    }

    public static function makeError($error){
        self::getViewContent($error,true);
    }

    protected static function getViewContent($view,$isError=false,$params=[]){
        
        $path=$isError ? view_path().'/errors/':view_path();
        
        if(str_contains($view,'.')){
           
          
            $views=explode('.',$view);
           
            foreach($views as $view){
               if(is_dir($path.'/'.$view)){
            
                $path=$path.'/'.$view.'/';

               }

            }
         $view=$path.'/'.end($views).'.php';
           
        }else{
          
            $view=$path.'/'.$view.'.php';
        }
        
        foreach($params as $param=>$value){
            $$param=$value;
        }
       
        if($isError){
           include $view;
        }else{
          
          
           include $view;
         
        }


    }

}
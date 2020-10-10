<?php
class Autoloader{
    public static function init(){
        spl_autoload_register([__CLASS__,'autoload']);
    }
    private static function autoload($className){
        if(is_file(CLASES.$className.'.php')){
            require_once CLASES.$className.'.php';
        }elseif(is_file(CONTROLLERS.$className.'.php')){
            require_once CONTROLLERS.$className.'.php';
        }elseif(is_file(MODELS.$className.'.php')){
            require_once MODELS.$className.'.php';
        }
        return;
    }
   
}
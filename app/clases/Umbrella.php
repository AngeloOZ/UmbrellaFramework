<?php
class Umbrella{
    /*
    * Propiedades del Framework
    */
    private $framework = '';
    private $version = '1.0.0';
    private $uri = [];

    function __construct()
    {
        $this->init();
    }

    /*
    * Cargador de configuracion 
    */
    private function init(){
        $this->initSession();
        $this->initLoadConfig();
        $this->initLoadFunction();
        $this->initAutoload();
        $this->init_csrf();
        $this->dispatch();
    }

    /*
    * Inicializacion de session del sistema
    */
    private function initSession(){
        if(session_status() == PHP_SESSION_NONE){
            session_set_cookie_params(60*60*24, '/', null, false, true );
            session_name('umbrella');
            session_start();
        }
        return;
    }

    /*
    * Cargar la configuracion del sistema
    */
    private function initLoadConfig(){
        $file = 'umbrella_config.php';
        if(!is_file('app/config/'.$file)){
            die("El archivo $file no se encuentra, es requerido para que $this->framework funcione.");
        }
        require_once 'app/config/'.$file;
        return;
    }

    /*
    * Metodo para cargar todas las funciones del sistema y el usuario
    */
    private function initLoadFunction(){
        //Carga funciones core del framework
        $file = 'umbrella_core_functions.php';
        if(!is_file(FUNCTIONS.$file)){
            die("El archivo $file no se encuentra, es requerido para que $this->framework funcione.");
        }
        require_once FUNCTIONS.$file;
        //Carga funciones custom del usuario
        $file = 'umbrella_custom_functions.php';
        if(!is_file(FUNCTIONS.$file)){
            die("El archivo $file no se encuentra, es requerido para que $this->framework funcione.");
        }
        require_once FUNCTIONS.$file;
        //Carga Otras funciones del usuario...
        return;
    }

    /*
    * Metodo para cargar todos archivos de forma automatica 
    */
    private function initAutoload(){
        require_once CLASES.'Autoloader.php';
        Autoloader::init();
        return;
    }

    /*
    * Crear un nuevo token 
    */
    private function init_csrf(){
        $csrf = new Csrf();
    }

    /*
    * Filtrar el url 
    */
    private function filterUrl(){
        if(isset($_GET['uri'])){
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri, '/');
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/', strtolower($this->uri));
            return $this->uri;
        }
    }

    /*
    * Metodo para ejecutar y cargar un controlador solicitado por el usuario 
    */
    private function dispatch(){
        $this->filterUrl();

        /*
        * Bloque para realizar la verificacion de E-mail
        */
        if(isset($_GET['confirm']) && (isset($_GET['token']) && !empty($_GET['token']))){
            require_once SYSTEM.'VerifyController.php';
            call_user_func(['VerifyController','index']);
            return;     
        }

        /*
        * Verificar si viene un controlador
        */
        $currentController = DEFAULT_CONTROLLER;
        if(isset($this->uri[0])){
            $currentController = $this->uri[0];
            unset($this->uri[0]);
        }else{
            // Redirect::to('home');
            $currentController = DEFAULT_CONTROLLER;
        }
        /*
        * Verificamos si existe una clase con el controlador solicitado
        */
        $controller = $currentController.'Controller';
        if(!class_exists($controller)){
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller'; //ErrorController
            $currentController = DEFAULT_ERROR_CONTROLLER;
        }

        /*
        * Verificamos el metodo solicitado
        */
        $currentMethod = DEFAULT_METHOD;
        if(isset($this->uri[1])){
            $method = str_replace('-','_',$this->uri[1]);
            if(!method_exists($controller, $method)){
                $controller = DEFAULT_ERROR_CONTROLLER.'Controller';
                $currentController = DEFAULT_ERROR_CONTROLLER;
                $currentMethod = DEFAULT_METHOD; //index
            }else{
                $currentMethod = $method;
            }
            unset($this->uri[1]);
        }
        /* Guardando el controlador y el metodo*/
        define('CONTROLLER', $currentController);
        define('METHOD', $currentMethod);

        /*
        * Ejecucion de un controlador y un metodo solicitado 
        */
        $controller = new $controller;
        $params = array_values(empty($this->uri)? [] : $this->uri);
        /* Llamada al metodo */
        if(empty($params)){
            call_user_func([$controller,$currentMethod]);
        }else{
            call_user_func_array([$controller,$currentMethod], $params);
        }
        return;
    }

    public static function started(){
        $bee = new self();
        return;
    }
}
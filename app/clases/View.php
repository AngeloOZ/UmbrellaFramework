<?php
class View{

    public static function render($view, $data, $titleView = null){
        // Convertir array asociativo a objeto
        // require_once CONFIG.'umbrella_style.php';
        $data = to_object($data);

        if($view == '/'){
            $path = VIEWS.'index.php';
            if(!is_file($path)){
                if(IS_LOCAL){
                    echo "<p>No se encontro el archivo \"index\" para ser cargado</p><br/>";
                    die;
                }else{
                    Redirect::to('404');
                }
            }
            require_once $path;
            return;
        }else{
            $view = str_replace('/','\\',$view);
            $path = VIEWS.$view.'.php';
            if(!is_file($path)){
                if(IS_LOCAL){
                    echo "<p>No se encontro la dirección o archivo: <code>$view</code></p><br/>";
                    echo "<spam>La ruta indicada o el archivo no existe: </spam>";
                    echo "<code>$path</code><br/>";
                    die;
                }else{
                    Redirect::to('404');
                }
            }
            require_once $path; 
            return;
        }

    }
}
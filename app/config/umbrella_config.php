<?php 
/*
* Verificamos si estamos en produccion o nivel local
*/
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1','::1']));

/*
* Nombre pricipal del sistema
*/
define('NAME_PROJECT', 'Umbrella - Framework');

/*
* Definir el TimeZone del sistema
*/
date_default_timezone_set('America/Guayaquil');

/* 
* Definir el lenguaje 
*/
define('LANG', 'es');

/* 
* Ruta de base de proyecto
* obtenida mediante substr($_SERVER['REQUEST_URI'], 1)
* Si da error modificarla manualmente
*/ 
define('BASEPATH', IS_LOCAL ?  (explode('/',$_SERVER['REQUEST_URI']))[1].'/': '__BASEPATH_PRODUCTION');
/*
* Salt del sistema puede ser opcional
*/
define('AUTH_SALT', 'una_super_sal_del_sistema');

/* 
* Puerto y la URL del sitio
* Definir puerto, por defecto 80
*/
define('PORT','80');
// define('PORT','8848');
define('URL',IS_LOCAL ? 'http://127.0.0.1:'.PORT.'/'.BASEPATH:'__URL_PRODUCCION');

/*
* Rutas de directorios principales y secundarios
*/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', getcwd().DS);
define('APP', ROOT.'app'.DS);
define('CLASES', APP.'clases'.DS);
define('PHPMAILER', APP.'PHPMailer'.DS);
define('SYSTEM', APP.'System'.DS);
define('CONFIG', APP.'config'.DS);
define('CONTROLLERS', APP.'controllers'.DS);
define('FUNCTIONS', APP.'functions'.DS);
define('MODELS', APP.'models'.DS);

define('TEMPLATE', ROOT.'template'.DS);
define('INCLUDES', TEMPLATE.'includes'.DS);
define('MODULES', TEMPLATE.'modules'.DS);
define('VIEWS', TEMPLATE.'views'.DS);

/*
* Rutas de archivos o assets con base URL absoluta
*/
define('ASSETS', URL.'assets/');
define('SYSTEM_URL', URL.'app/System/');
define('CSS', ASSETS.'css/');
define('FAVICON', ASSETS.'favicon/');
define('FONTS', ASSETS.'fonts/');
define('IMAGES', ASSETS.'images/');
define('JS', ASSETS.'js/');
define('PLUGINS', ASSETS.'plugins/');
define('UPLOADS', ASSETS.'uploads/');

/*
* Credenciales de base de datos locales
*/
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'u4_p1_db');
define('LDB_USER', 'root');
define('LDB_PASS', '');
define('LDB_CHARSET', 'utf8');

/*
* Credenciales de base de datos en Produccion
*/
define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '__REMOTE_DB__');
define('DB_USER', '__REMOTE_DB__');
define('DB_PASS', '__REMOTE_DB__');
define('DB_CHARSET', 'utf8');

/*
* Controladores y metodos por defecto
*/
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ERROR_CONTROLLER', 'error');
define('DEFAULT_METHOD', 'index');

/*
* Configuracion de correo nivel temporal
*/
define('EMAIL_SENDER', 'Umbrella Framework');
define('EMAIL_USER', 'mysqlremote123@gmail.com');
define('EMAIL_PASSWORD', 'Milena200');
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORT', '587');

// echo URL;

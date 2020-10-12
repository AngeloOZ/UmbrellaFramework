<?php
/**
* Hola, amigo
* para hacer uso de la verificación de e-mail
* te recomendamos que uses la siguiente estrucura de tabla, sino configurelo a su gusto.
* op = opcional.
* id, name, lastname(op), username(op), email, password, verification, token_user,created_at, updated_at;
* DROP TABLE IF EXISTS `users`;
* CREATE TABLE `users` (
*  `id` bigint(10) NOT NULL AUTO_INCREMENT,
*  `name` varchar(100) NOT NULL,
*  `lastname` varchar(100) NULL,
*  `username` varchar(50) NULL,
*  `email` varchar(100) NOT NULL,
*  `password` varchar(100) NOT NULL,
*  `verification` varchar(5) NOT NULL,
*  `token_user` varchar(100) NOT NULL,
*  `created_at` datetime NOT NULL,
*  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
*  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
* @return 
*/

class CheckEmail{
    private $NombreTable = "users"; 
    private $campo = "email";
    private $email;
    
    function __construct($email)
    {
        $this->email = $email;
    }
    private function getDataUser(){
        $dato = $this->email;
        $data = Db::unique($this->NombreTable, $this->campo, $dato);
        return ($data->rowCount() == 1) ? $data->fetch(PDO::FETCH_ASSOC) : $data->fetchAll(PDO::FETCH_ASSOC);
        
    }
    private function generateToken(){
        $data = $this->getDataUser();
        if(!empty($data)){
            $jwt = array(
                "token" => $data['token_user'],
                "user" => ["name"=>$data['name'], "email" => $data['email']]
            );
            return base64_encode(json_encode($jwt));
        }
        return null;
    }
    public static function sendTokenEmail($email){
        $self = new self($email);
        $token = $self->generateToken();
        if($token !== null){
            $to = $email;
            $subject = "Último paso para activar tu cuenta de ".NAME_PROJECT;
            $message = "
            <html>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <style>
                    body{
                        font-family: sans-serif;
                        width: 90%;
                        margin: auto;
                    }
                    h1{
                        padding: 0;
                        margin-left: 10px;
                        font-size: 20px;
                    }
                    .logo{
                        width: 200px;
                        display: flex;
                        align-items: center;
                        padding-left: 10px;
                        margin-top: 20px;
                    }
                    .logo img{
                        max-width: 100%;
                        width: 50px;
                        height: 50px;
                    }
                    .correo{
                        font-size: 25px;
                        color: #c5c5c5;
                    }
                    .contenido{
                        /* width: 90%; */
                        margin: auto;
                        padding: 0 15px;
                    }
                    .btn{
                        display: block;
                        background-color: #ED1C24;
                        height: 50px;
                        width: 210px;
                        text-align: center;
                        text-decoration: none;
                        color: #fff;
                    }
                    .text{
                        line-height: 25px;
                    }
                    .enlace{
                        color: #ED1C24;
                    }
                </style>
            </head>
            <body>
                <div class='logo'>
                    <img src='https://lezebre.lu/images/detailed/28/80256-sticker-Umbrella-Corporation-Resident-Evil.png' alt='logo umbrella'>
                    <h1>".NAME_PROJECT."</h1>
                </div>
                <div class='contenido'>
                    <p class='correo' >{$email}</p>
                    <p class='text'>Te falta un paso para activar tu cuenta de ".NAME_PROJECT.". Haz clic en el siguiente botón para confirmar tu dirección de correo electrónico:</p>
                    <a href='".URL."?confirm&token={$token}' target='_blanck' class='btn'>Confirmar mi correo electrónico</a>
                    <p class='text'>¿No funcionó? Copia el siguiente enlace en tu navegador web:</p>
                    <p class='enlace'>".URL."?confirm&token={$token}</p>
                    <footer>
                        Saludos cordiales,<br>
                        — El Equipo ".NAME_PROJECT."
                    </footer>
                </div>
            </body>
            </html>
            ";
            if(Email::sendMail($to,$subject,$message)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
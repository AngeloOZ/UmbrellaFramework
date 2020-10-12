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
    public static function validateEmail($email){
        $self = new self($email);
        $token = $self->generateToken();
        if($token !== null){
            return $token;
        }else{
            return "error";
        }
    }
}
<?php
class HomeController implements Controller{
    function __construct()
    {
    }

    function index(){
        $data = ["title" => "", "bg" =>'dark'];
        View::render("/",$data,"");
    }
    function usuario(){
        echo "Hola usuario<br/>";
        // $res = CheckEmail::sendTokenEmail('angelo-mjz7@hotmail.com');
        // if($res){
        //     echo "Revice su bandeja de entrada para confirmar su cuenta<br/>";
        // }else{
        //     echo "Hubo un error al crear la cuenta intentelo de nuevo<br/>";
        // }
    }
    function send(){
        echo "Hola soy send <br/>";
        $to = ["email" => "angelo-mjz7@hotmail.com", "name" => "Angello"];
        $subject = 'Es una prueba de email';
        $message = 'Ud. ha recibido el correo de prueba correctamente';
        // $send = Email::sendMail($to, $subject, $message);
        // if($send == "ok"){
        //     echo "Correo enviado";
        // }else{
        //     echo $send;
        // }
    }
}
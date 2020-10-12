<?php
class HomeController implements Controller{
    function __construct()
    {
    }

    function index(){
        $data = ["title" => "", "bg" =>'dark'];
        View::render("/",$data,"");
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
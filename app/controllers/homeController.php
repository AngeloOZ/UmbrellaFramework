<?php
class homeController implements Controller{
    function __construct()
    {
    }

    function index(){
        $data = ["title" => ""];
        View::render("home/",$data,"");
    }
}
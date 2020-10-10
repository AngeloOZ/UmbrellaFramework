<?php
class homeController implements Controller{
    function __construct()
    {
    }

    function index(){
        $data = ["title" => "", "bg" =>'dark'];
        View::render("/",$data,"");
    }
}
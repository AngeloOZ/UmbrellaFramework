<?php
class errorController{
    function __construct()
    {

    }

    function index(){
        $data = array('title' => 'Error', 'bg' =>'dark');
        view::render('error/404',$data);
    }
}
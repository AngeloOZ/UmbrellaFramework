<?php
class errorController{
    function __construct()
    {

    }

    function index(){
        $data = array('title' => 'Error', 'bg' =>'dark');
        view::render('404',$data);
    }
}
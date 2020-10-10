<?php 
class beeController implements Controller{
    function index(){
        View::render('home/index',["title"=>"hola", "bg"=>"dark"]);
    }
}
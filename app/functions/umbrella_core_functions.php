<?php
function to_object($array){
    if(is_array($array)){
        return json_decode(json_encode($array));
    }else{
        return null;
    }
}
function get_sitename(){
    return NAME_PROJECT;
}

function now(){
    return Date('Y-m-d H:i:s');
}

function filterText($string){
    return filter_var($string, FILTER_SANITIZE_STRING);
}
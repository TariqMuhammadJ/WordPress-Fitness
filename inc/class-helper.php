<?php 

if(!function_exists('get_menu')){
    function get_menu(){
        include DIR . '/parts/parts-menu.php';
    }
}

if(!function_exists('locate_part')){
    function locate_part($slug){
        include DIR . "/parts/parts-{$slug}.php";
    }
}


if(!function_exists('get_logo')){
    function get_logo(){
        locate_part('logo');
    }
}

?>
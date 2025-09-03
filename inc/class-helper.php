<?php 

if(!function_exists('get_menu')){
    function get_menu(){
        include DIR . '/parts/parts-menu.php';
    }
}

if(!function_exists('locate_part')){
    function locate_part($slug){
        $file =  DIR . "/parts/parts-{$slug}.php";
        if(file_exists($file)){
            include $file;
        }
    }
}


if(!function_exists('get_logo')){
    function get_logo(){
        locate_part('logo');
    }
}


if(!function_exists('get_read_time')){
    function get_read_time($post_id = null){
        if(!$post_id){
            $post_id = get_the_ID();
            $post_content = get_post_field('post_content', $post_id);
            $post_content = strip_shortcodes($post_content);
            $post_content = wp_strip_all_tags($post_content);
            $word_count = str_word_count($post_content);
            $reading_speed = 200;
            $minutes = ceil($word_count/$reading_speed);

            if($minutes <= 1){
                $time = '1 min Read';
            }
             else {
                $time = $minutes . 'min Read';
             }

            return $time;

                
        }
    }
}


?>
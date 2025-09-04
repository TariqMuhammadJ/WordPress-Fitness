<?php 

get_header();
 
if(is_page('blog')){
    locate_part('blog');
}
else{
    locate_part('static');
}

get_footer();


?>
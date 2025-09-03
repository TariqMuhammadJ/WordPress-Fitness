<?php 

get_header();
 
if(is_page('blog')){
    locate_part('blog');
}
else{
    the_content();
}

get_footer();


?>
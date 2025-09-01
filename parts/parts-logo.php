<?php 
if ( function_exists('the_custom_logo') && has_custom_logo() ) {
    the_custom_logo();
} else {
    echo '<a href="' . esc_url(home_url('/')) . '" class="site-title"><strong>';
    bloginfo('name'); 
    echo '</strong></a>';
}
?>

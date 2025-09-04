<?php get_header(); ?> 
<main class="main-body tag-page">
    <?php get_menu(); ?>
    <div class="tag-page-results">
        <?php MainPosts::regularQuery(); ?>
    </div>

</main>



<?php get_footer(); ?>
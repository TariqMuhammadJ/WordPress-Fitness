<?php 



get_header();

?>

<main class="main-body">
    <?php get_menu() ?>
    <div class="cta">
        <section class="cta-text">
            <div class="main-area">
                <h1><strong>Build Perfect Body with Clean Mind</strong></h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis nam impedit quis esse distinctio illum perferendis, animi id ex iure deleniti, quam explicabo laudantium adipisci voluptate sint inventore culpa facere!</p>
                <a href="">Get Started</a>

            </div>
           
        </section>
        <?php locate_part('social') ?>
    </div>
</main>
<div class="second-page">
   
        <?php locate_part('cta');
        ?>
    
</div>



<?php
get_footer();


?>
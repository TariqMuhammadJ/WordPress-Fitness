<main class="main-body about">
    <? get_menu() ?>
    <div class="blog-section">
        <section class="blog">
                    <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
        </section>
    <section class="side-bar">
        <?
        if(is_active_sidebar('main-sidebar')){
            dynamic_sidebar('main-sidebar');
        }
        ?>
    </section>
    </div>
    
</main>


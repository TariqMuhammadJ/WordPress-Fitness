<main class="main-body blog-page">
    <? get_menu() ?>
    <div class="blog-section">
        <section class="blog">
                    <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
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


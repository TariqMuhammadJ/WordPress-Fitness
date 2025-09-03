<?php get_header(); ?>

<main class="main-body single-post">
    <?php get_menu(); ?>
    <div class="single-main">

    <?php if ( have_posts() ) : 
        while ( have_posts() ) : 
            the_post(); 
            $postId = get_the_ID(); 
            ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <section class="entry-title">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="meta-info">
                    <span class="author-name">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
                            <?php echo esc_html( get_the_author() ); ?>
                        </a>
                    </span>
                    <span class="date">
                        <?php echo esc_html( get_the_date() ); ?>
                    </span>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'single-thumb' ); ?>
                <?php endif; ?>
            </section>

            <section class="entry-content">
                <?php the_content(); ?>
            </section>
        </article>
        <?php
        endwhile;
    endif;
    ?>
    <?php 
    if ( ! empty( $postId ) ) {
        // Get raw content and run normal WP formatting
        $content = get_post_field( 'post_content', $postId );
        echo apply_filters( 'mt_toc_content', $content );
    }
    ?> 
    </div>
</main>

<?php get_footer(); ?>

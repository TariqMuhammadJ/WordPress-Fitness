<?php get_header(); ?>
<main class="main-body search-results">
    <?php get_menu(); ?> 
    <div class="main-search-page">
        <div class="search-results">
        <div class="query">
            <p class="search-term">Search Results For : <?php echo get_search_query(); ?> </p>
        </div>
        <?php if(have_posts()) : ?>  
            <? while(have_posts()) : the_post(); ?>
            <article class="search-articles">
            <section class="thumb">
                <? if(has_post_thumbnail()){
                    the_post_thumbnail('featured-thumb');

                }
                ?>
            </section>
            <div class="meta-search">
                <section class="heading">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php locate_part('tags'); ?>
                <span class="author"><?php the_author(); ?></span>
            </section>
            <section class="search-content">
                <?php the_excerpt(); ?>
            </section></div> 
            </article>
            <? endwhile; ?>
            <? endif; ?>      
    </div>
    <div class="search-side">
        <?php locate_part('form'); ?>
    </div>
    </div>

</main>

<?php get_footer(); ?>
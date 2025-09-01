<?php 

if(!class_exists('MainPosts')){
    class MainPosts{
        public function __construct(){

        }

        public static function page_list(){
            
$latest_pages = new WP_Query([
    'post_type'      => 'page',
    'posts_per_page' => 5,     // how many pages to show
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

if ($latest_pages->have_posts()) :
    ?> <ul> <?
    while ($latest_pages->have_posts()) : $latest_pages->the_post(); ?>
            <li><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></li>
    <?php endwhile;

    ?> </ul> <?
endif;

wp_reset_postdata();
?>
<?
        }

        public static function featured($cat){
            $featured = new WP_Query([
                'category_name' => $cat, 
                'posts_per_page' => 1,
            ]);

            if($featured->have_posts()) : 
                while($featured->have_posts()) : $featured->the_post(); ?>
                 <article class="featured-post">
            <h2><?php the_title(); ?></h2>
            <?php the_post_thumbnail('large'); ?>
            <?php the_excerpt(); ?>
        </article>
    <?php endwhile;
endif;

wp_reset_postdata();

        }
    }
}
<?php

if (!class_exists('MainPosts')) {
    class MainPosts
    {
        public function __construct() {
            add_filter('walker_nav_menu_start_el', [$this,'add_icon_to_menu'], 10, 4);
            add_action('wp_ajax_get_form', [$this, 'display_form_mobile']);
            add_action('wp_ajax_nopriv_get_form', [$this, 'display_form_mobile']);
            add_filter('excerpt_length', [$this, 'custom_excerpt_length']);
            add_filter('the_content', [$this, 'mt_add_heading_ids']);
            add_filter('mt_toc_content', [$this, 'mt_generate_toc']);
            add_filter('the_excerpt', [$this, 'filters_gen']);
        }

        public function filters_gen($excerpt){
             if (has_tag('trending')) {
                $excerpt .= ' 🔥 <strong>This post is trending!</strong>';
            }
            return $excerpt;
        }

        public function mt_add_heading_ids($content){
             return preg_replace_callback('/<h([1-6])[^>]*>(.*?)<\/h[1-6]>/', function($matches) {
                    $level = $matches[1];
                    $text  = strip_tags($matches[2]);
                    $id    = sanitize_title($text);
                    return '<h'.$level.' id="'.$id.'">'.$matches[2].'</h'.$level.'>';
                }, $content);
        }
        public function mt_generate_toc($content){
                preg_match_all('/<h([1-6])[^>]*>(.*?)<\/h[1-6]>/', $content, $matches, PREG_SET_ORDER);
                if (empty($matches)) {
                    return '';
                }
            $toc = '<aside class="table-of-contents"><ul>';

            foreach ($matches as $i => $heading) {
                $level = $heading[1];
                $text  = strip_tags($heading[2]);
                $id    = sanitize_title($text);


                // Add to TOC list
                $toc .= '<li class="toc-level-'.$level.'"><a href="#'.$id.'">'.$text.'</a></li>';
            }

                $toc .= '</ul></aside>';

            // Insert TOC at the beginning of the content
                return $toc;

    }

        public function display_form_mobile(){
            ob_start();
            locate_part('form');
            $html = ob_get_clean();
            wp_send_json_success($html);
        }

        public function custom_excerpt_length($length){
            if(has_tag('trending')){
                return 40;
            }
            if(is_search()){
                return 30;
            }
            return 10;


        }


        public function add_icon_to_menu($item_output, $item, $depth, $args)
        {
            if ($args->theme_location == 'primary_menu') {

                // Example: add icons based on menu item title
                switch ($item->title) {
                    case 'Home':
                        $icon = '<i class="fas fa-home menu-icon"></i> ';
                        break;
                    case 'About':
                        $icon = '<i class="fas fa-info-circle menu-icon"></i> ';
                        break;
                    case 'Contact':
                        $icon = '<i class="fas fa-phone menu-icon"></i> ';
                        break;
                    case 'Blog':
                        $icon = '<i class="fas fa-blog menu-icon"></i></i>';
                        break;
                    default:
                        $icon = ''; // no icon
                }

                // Wrap the menu item text in a span for styling (optional)
                $item_output = $icon . '<a href="' . esc_url($item->url) . '"><span class="menu-text">' . esc_html($item->title) . '</span></a>';

            }
            return $item_output;
        }
        public static function page_list()
        {

            $latest_pages = new WP_Query([
                'post_type'      => 'page',
                'posts_per_page' => 5,     // how many pages to show
                'orderby'        => 'date',
                'order'          => 'DESC'
            ]);

            if ($latest_pages->have_posts()) :
        ?> <ul> <?
                while ($latest_pages->have_posts()) : $latest_pages->the_post(); ?>
                        <li>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </li>
                    <?php endwhile;

                    ?>
                </ul> <?
                    endif;

                    wp_reset_postdata();
                        ?>
            <?
        }

        public static function featured($cat)
        {
            $featured = new WP_Query([
                'tag' => 'trending, updates',
                'posts_per_page' => 1,
            ]);

            if ($featured->have_posts()) :
                while ($featured->have_posts()) : $featured->the_post(); ?>
                    <article class="featured-post">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('featured-thumb', ['class' => 'featured-img']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                        <div class="text-outro">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?
                            $tags = get_the_tags();
                            if ( $tags ) {
                                echo '<ul class="post-tags">';
                                foreach ( $tags as $tag ) {
                                    echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                            <?php the_excerpt(); ?>
                            <span class="read-time"><?php echo get_read_time(); ?></span>
                        </div>
                    </article>
                <?php endwhile;
            endif;

            wp_reset_postdata();
        }


       public static function latest_posts() {
        $latest = new WP_Query([
            'posts_per_page' => 4,
            'order'          => 'DESC'
        ]);

        if ($latest->have_posts()) : 
            while ($latest->have_posts()) : $latest->the_post(); ?>
                <article <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('latest-thumb', ['class' => 'latest-img']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="text-outro">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                         <?php locate_part('tags'); ?>
                        <?php the_excerpt(); ?>
                        <span class="read-time"><?php echo get_read_time(); ?></span>
                    </div>
                </article>
            <?php endwhile;
        else :
            echo '<p>No posts found.</p>';
        endif;

        wp_reset_postdata();
    }

    public static function regularQuery(){
        if(have_posts()) : 
            while(have_posts()) : the_post(); ?>
             <article <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('latest-thumb', ['class' => 'latest-img']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="text-outro">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                         <?php locate_part('tags'); ?>
                        <a href="<?php the_permalink(); ?>"><?php the_excerpt()?></a>
                        <span class="read-time"><a href="<?php the_permalink(); ?>"><?php echo get_read_time(); ?></a></span>
                    </div>
                </article>
            <?php endwhile;
        else :
            echo '<p>No posts found.</p>';
        endif;

        wp_reset_postdata();

    }

    }

    new MainPosts();
}

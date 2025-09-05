<?php 

if(!class_exists('MainAssets')){
    class MainAssets {

    private static string $version;

    
    public function __construct(){
        self::$version = wp_get_theme()->get('Version');
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('after_setup_theme', [$this, 'setup_items']);
        add_action('widgets_init', [$this, 'register_sidebar']);
        /*add_action('init', [$this, 'maintenance']);*/
        


    }

    /*public function maintenance(){
        if(!is_user_admin()){
            locate_part('maintenance');
            exit;
        }
    }*/

    /* filemtime(FITNESS_DIR . '/css/main-style.css') */

    public function enqueue_assets(){
        wp_enqueue_style('main-style', FITNESS_DIR . '/css/main-style.css', [], self::$version);
        wp_enqueue_style('blog-style', FITNESS_DIR . '/css/blog-style.css', [], self::$version);
        wp_enqueue_script('main-js', FITNESS_DIR . '/js/main.js', [], self::$version);
        wp_localize_script('main-js', 'my_ajax',[
            'url' => admin_url('admin-ajax.php')
        ]);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
        wp_enqueue_style('google-icon', "https://fonts.googleapis.com/icon?family=Material+Icons");
        wp_enqueue_style('gym-icons', "https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined");
        $image_url = get_theme_mod('hero_image');
        wp_add_inline_style('main-style', ":root{--hero-img:url('{$image_url}')}");



    }

    public function setup_items(){

        add_theme_support('align-wide');

        add_theme_support('editor-styles');
        add_editor_style('editor-style.css'); // optional: your custom editor stylesheet

        // Optional: Add a custom color palette
        add_theme_support('editor-color-palette', [
            [
                'name'  => __('Primary Blue', 'your-theme'),
                'slug'  => 'primary-blue',
                'color' => '#0073aa',
            ],
            [
                'name'  => __('Light Gray', 'your-theme'),
                'slug'  => 'light-gray',
                'color' => '#f5f5f5',
            ],
        ]);

        // Optional: Add custom font sizes
        add_theme_support('editor-font-sizes', [
            [
                'name' => __('Small', 'your-theme'),
                'size' => 12,
                'slug' => 'small'
            ],
            [
                'name' => __('Large', 'your-theme'),
                'size' => 36,
                'slug' => 'large'
            ]
        ]);

            // Optional: support for responsive embedded content
        add_theme_support('responsive-embeds');

        
            register_nav_menus([
        'primary_menu' => __('Primary Menu', textdomain)
       ]);

       add_theme_support('custom-logo', [
        'height' => 100, 
        'width' => 400, 
        'flex-height' => true,
        'flex-width' => true,
       ]);

        add_image_size('featured-thumb', 450, 300, true);
        add_image_size('latest-thumb', 200, 133, true);
        add_image_size( 'single-thumb', 900, 400, true ); // 600x400 cropped

    }

    public function register_sidebar(){
        register_sidebar(array(
            'name' => __('Main Sidebar', textdomain),
            'id' => 'main-sidebar',
            'description' => 'widgets added here will appear in the sidebar',
            'before_widget' => '<div id="blog-widget" class="blog-widgets">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
    }



}

}

new MainAssets();
?>
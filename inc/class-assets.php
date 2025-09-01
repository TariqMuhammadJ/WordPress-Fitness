<?php 

if(!class_exists('MainAssets')){
    class MainAssets {

    private static string $version;

    
    public function __construct(){
        self::$version = wp_get_theme()->get('Version');
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('after_setup_theme', [$this, 'setup_items']);


    }

    public function enqueue_assets(){
        wp_enqueue_style('main-style', FITNESS_DIR . '/css/main-style.css', [], self::$version);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
        wp_enqueue_style('google-icon', "https://fonts.googleapis.com/icon?family=Material+Icons");
        wp_enqueue_style('gym-icons', "https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined");
        $image_url = get_theme_mod('hero_image');
        wp_add_inline_style('main-style', ":root{--hero-img:url('{$image_url}')}");



    }

    public function setup_items(){
       register_nav_menus([
        'primary_menu' => __('Primary Menu', textdomain)
       ]);

       add_theme_support('custom-logo', [
        'height' => 100, 
        'width' => 400, 
        'flex-height' => true,
        'flex-width' => true,
       ]);
    }



}

}

new MainAssets();
?>
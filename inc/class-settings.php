<?php 

if(!class_exists('MainSettings')) {
    class MainSettings{
        public function __construct(){
            add_action('customize_register', [$this, 'fitness_customize']);
        }

        public function fitness_customize($wp_customize){
            $wp_customize->add_setting('hero_image', array(
                'default' => FITNESS_DIR . '/screenshot.jpg',
                'transport' => 'postMessage'
            ));

            $wp_customize->add_control(new WP_Customize_Image_Control(
                $wp_customize,
                'hero_image_control', 
                array(
                    'label' => __('Hero Section Image', textdomain), 
                    'section' => 'title_tagline',
                    'settings' => 'hero_image'
                )
                ));

        }
    }


}


new MainSettings();
?>
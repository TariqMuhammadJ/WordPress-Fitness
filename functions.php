<?php 

if(!class_exists('mainLoader')){
    class mainLoader{
        private static $instance = null;

        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new self();
            }
            return self::$instance;
        }

        private function __construct(){
            $this->set_constants();
            $this->load_files();
        }


        public function set_constants(){
            if(!defined('textdomain')){
                define('textdomain', 'fitness');
            }
            if(!defined('DIR')){
                define('DIR', get_template_directory());
            }
            if(!defined('FITNESS_DIR')){
                define('FITNESS_DIR', get_template_directory_uri());
            }
        }

        public function load_files(){
            require_once DIR . '/inc/class-settings.php';
            require_once DIR . '/inc/class-assets.php';
            require_once DIR . '/inc/class-helper.php';
        }
    }
}

function loadTheme(){
    mainLoader::getInstance();

}

loadTheme();



?>
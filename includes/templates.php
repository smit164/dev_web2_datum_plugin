 <?php

    class Templates {
        private static $instance;

        protected $templates;

        public static function get_instance() {
            if ( null == self::$instance ) {
                self::$instance = new Templates();
            }

            return self::$instance;
        }

        private function __construct() {
            $this->templates = array();

            if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
                add_filter(
                    'page_attributes_dropdown_pages_args',
                    array( $this, 'register_project_templates' )
                );
            } else {
                add_filter(
                    'theme_page_templates', array( $this, 'add_new_template' )
                );
            }

            add_filter(
                'wp_insert_post_data',
                array( $this, 'register_project_templates' )
            );

            add_filter(
                'template_include',
                array( $this, 'view_project_template')
            );

            $this->templates = array(
                'my-account'       => 'My Account',
                'dashboard.php'    => 'Dashboard',
            );
        }

        public function add_new_template( $posts_templates ) {
            $posts_templates = array_merge( $posts_templates, $this->templates );
            return $posts_templates;
        }

        public function register_project_templates( $atts ) {
            $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
            
            $templates = wp_get_theme()->get_page_templates();
            if ( empty( $templates ) ) {
                $templates = array();
            }

            wp_cache_delete( $cache_key , 'themes');
            $templates = array_merge( $templates, $this->templates );

            wp_cache_add( $cache_key, $templates, 'themes', 1800 );

            return $atts;
        }

        public function view_project_template( $template ) {

            global $post;

            if ( ! $post ) {
                return $template;
            }

            $template_br = $this->get_file_url();


            if($template_br){
                return $template_br;    
            }

            if ( ! isset( $this->templates[get_post_meta(
                $post->ID, '_wp_page_template', true
            )] ) ) {
                return $template;
            }



            $file = DM_ABSPATH . 'template/'. $this->get_file_url() .'.php';
            
            
            if ( file_exists( $file ) ) {
                return $file;
            } else {
                echo $file;
            }

            return $template;
        }

        public function  get_file_url(){
            global  $post;
            $post_name = get_post_meta($post->ID, 'datum_main_page', true);
            if($post_name){
                $file_name = get_query_var('args');
                if($file_name != ''){
                    return  DM_ABSPATH . 'template/'. $file_name.'.php';
                }else{
                    return DM_ABSPATH . 'template/my-account.php';
                }
            }else{
                return; 
            }
        }
    }

    //add_action( 'plugins_loaded', array( 'Templates', 'get_instance' ) );
?>
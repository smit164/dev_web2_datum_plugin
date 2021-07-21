<?php
/**
 * datum setup
 *
 * @package datuuserince   3.2.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main datum Class.
 *
 * @class datum
 */
if(!class_exists('WP_List_Table')){
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
if (!class_exists('datum')) {
		
	final class datum {
		
		private static $instance;
		public $version = "1.0.0";
		
		public $wp_version = "3.5";
		
		public static function instance() {
			if (!isset(self::$instance) && !(self::$instance instanceof datum)) {
				self::$instance = new datum;
			}
			return self::$instance;
		}
		
		public function __construct() {
					
			if (!$this->check_requirements()) {
				return;
			}
			$this->define_constants();
			$this->define_tables();
			$this->includes();
			$this->init_hooks();
			$this->create_options();
			//
			// Activation Hooks
			//
			register_deactivation_hook(__FILE__, array($this, 'deactivate'));
			register_uninstall_hook(__FILE__, 'datum::uninstall');
		}
		/**
		 * Define DM Constants.
		 */
		private function define_constants() {
			$upload_dir = wp_upload_dir( null, false );

			$this->define( 'DM_ABSPATH', dirname( DM_PLUGIN_FILE ) . '/' );
			$this->define( 'DM_PLUGIN_BASENAME', plugin_basename( DM_PLUGIN_FILE ) );
			$this->define( 'DM_VERSION', $this->version );
			$this->define( 'WOOCOMMERCE_VERSION', $this->version );
			$this->define( 'DM_DATE', date('Y-m-d H:i:s') );
			$this->define( 'DM_ROUNDING_PRECISION', 6 );
			$this->define( 'DM_DISCOUNT_ROUNDING_MODE', 2 );
			$this->define( 'DM_DELIMITER', '|' );
			$this->define( 'DM_LOG_DIR', $upload_dir['basedir'] . '/dm-logs/' );
			$this->define( 'DM_SESSION_CACHE_GROUP', 'dm_session_id' );
			$this->define( 'DM_TEMPLATE_DEBUG_MODE', false );
			$this->define( 'DM_NOTICE_MIN_PHP_VERSION', '7.2' );
			$this->define( 'DM_NOTICE_MIN_WP_VERSION', '5.2' );
			$this->define( 'Datum_API_URL', 'http://api.newmarkpcg.com/api/v1/' );
			$this->define( 'DATUM_PLUGIN_URL', plugin_dir_url( __DIR__ ) );
			$this->define( 'DATUM_PLUGIN_IMAGES_URL', plugin_dir_url( __DIR__ ).'images/' );
			$this->define( 'DATUM_DOCUMENTVAULT_PATH', $upload_dir['basedir']."/PropertyDocumentVault/" );
			$this->define( 'DATUM_SENDGRID_FROM_EMAIL', 'NewmarkPCG@nmrk.com');
			$this->define( 'DATUM_SENDGRID_FROM_NAME', 'Newmark Private Capital Group' );
            $this->define( 'DATUM_ILOVEPDF_KEY', 'project_public_38e9169b628d1d5956850f06a73a3678_MdeUPae0eff300f7c3984fb280e389c48a3ec' );
            $this->define( 'DATUM_ILOVEPDF_SECRET_KEY', 'secret_key_d8ca5fbfa93a57e9afa976aae0e20077_Ajh9H6a6412f9e14da3eb78f7be1d369d7f8b' );
		}

		/**
		 * Register custom tables within $wpdb object.
		 */
		private function define_tables() {
			global $wpdb;

			// List of tables without prefixes.
			$tables = array(
			);

			foreach ( $tables as $name => $table ) {
				$wpdb->$name    = $wpdb->prefix . $table;
				//$wpdb->tables[] = $table;
			}
		}

		public function create_options(){
			include_once dirname( __FILE__ ) . '/admin/class-dm-admin-settings.php';
			$settings = DM_Admin_Settings::get_settings_pages();


			foreach ( $settings as $section ) {
				if ( ! method_exists( $section, 'get_settings' ) ) {
					continue;
				}
				/*$subsections = array_unique( array_merge( array( '' ), array_keys( $section->get_sections() ) ) );
					
				foreach ( $subsections as $subsection ) {
					foreach ( $section->get_settings( $subsection ) as $value ) {
						if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
							$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
							add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
						}
					}
				}*/
			}
		}

		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public function includes() {
			/**
			 * Core classes.
			 */
			
			include_once DM_ABSPATH . 'includes/dm-template-hooks.php';
			
			include_once DM_ABSPATH . 'includes/dm-template-functions.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-frontend-scripts.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-page.php';

			include_once DM_ABSPATH . 'includes/class-dm-ajax.php';

			include_once DM_ABSPATH . 'includes/class-dm-social.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-signup.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-curl.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-query.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-shortcode.php';
			
			include_once DM_ABSPATH . 'includes/dm-core-functions.php';
			
			include_once DM_ABSPATH . 'includes/class-datum-email-send.php';

			include_once DM_ABSPATH . 'sendgrid-API/sendgrid-php.php';

			if ( $this->is_request( 'admin' ) ) {
				include_once DM_ABSPATH . 'includes/admin/class-dm-admin.php';
			}
			
			include_once DM_ABSPATH . 'includes/Modules/propery-functions.php';
			
			include_once DM_ABSPATH . 'includes/Modules/user-functions.php';
			$this->query = new DM_Query();
			

			include_once DM_ABSPATH . 'sendgrid-API/sendgrid-php.php';
			/*
			

			
			include_once DM_ABSPATH . 'includes/class-projects-grid.php';
			
			include_once DM_ABSPATH . 'includes/dm-template-sql.php';
			
			include_once DM_ABSPATH . 'includes/class-dm-ajax.php';

			include_once DM_ABSPATH . 'includes/templates.php';
			

			include_once DM_ABSPATH . 'includes/User.php';

			if ( $this->is_request( 'admin' ) ) {
				include_once DM_ABSPATH . 'includes/admin/class-dm-admin.php';
			}

			*/
		}

		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin':
					return is_admin();
				case 'ajax':
					return defined( 'DOING_AJAX' );
				case 'cron':
					return defined( 'DOING_CRON' );
				case 'frontend':
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! $this->is_rest_api_request();
			}
		}
	
		public function init_hooks(){
			
			//add_action( 'init', array($this, 'datumProject') );

			add_action( 'add_meta_boxes', array($this, 'custom_post_meta') );

			//add_action('admin_enqueue_scripts', array($this,'admin_scripts_data') );
			add_action('wp_enqueue_scripts', array($this, 'custom_scripts'));

			//add_shortcode('news_shortcode',array($this, 'news_shortcode'));

			add_action( 'datum_sidebar', array($this, 'datum_sidebar') );
			//add_action( 'news_end_loop', array($this, 'news_end') );
			//add_action( 'news_title', array($this, 'get_news_title') );

			//add_action( 'save_post', array($this, 'save_custom_meta_data') );

			//add_filter( 'template_include', array($this, 'include_template_function'));
			//Ajax
			add_action('wp_ajax_user_login',array($this, 'user_login'));
			add_action('wp_ajax_nopriv_user_login',array($this, 'user_login'));


			add_action('admin_init', array($this, 'ui_new_role'));

			add_action('init', array($this, 'add_my_rule'));
			
			add_action('wp', array($this, 'checkValidPage'));

			add_filter('wp_nav_menu_items', 'add_attribute', 10, 2);

			add_filter( 'wp_nav_menu_items', array($this,'add_login_logout_register_menu'), 199, 2 );
			
			add_action( 'wp_footer', array($this,'addFooterHtml'), 199, 2 );

            add_action( 'init', array($this,'userVerification'));

		}

		public function ui_new_role(){
			add_role(
		        'customer',
		        'Customer',
		        array(
		            'read'         => true,
		            'delete_posts' => false
		        )
		    );
		}

		public function datum_sidebar(){

		}

		public function sidebar(){
		}

		public function custom_post_meta(){
			add_meta_box(
				'custom-news',
				__( 'Custom Data', 'datum' ),
				array($this, 'custom_meta_box_callback'),
				'project'
			);
		}

		public function custom_meta_box_callback(){
		}

		public function include_template_function( $template_path ) {

			$post_name 		= get_option('datum_property_listing_id');
			
			$post_type 		= get_option('datum_property_type_id');
			
			$post_closed 	= get_option('datum_property_closed_id');
			
			$agent_id 		= get_option('datum_agent_id');
			
			$datum_my_listing_page_id = get_option('datum_my_listing_page_id');

            $datum_my_favrite_listing_page_id = get_option('datum_my_favorite_listing_page_id');

            $datum_user_verification_page_id = get_option('datum_user_verification_page_id');


            global $post,$property,$single_property, $datum_user,$mypropertylist, $favritesProperty;

			/*if($post_name == $post->ID){
				$propertyId = get_query_var('args');
				if($propertyId != ''){
					$id = "property/".$propertyId;
					$data = DM_Curl::HTTPGet($id);
		            $property = json_decode($data);
		            $single_property = $property->data;
		            $data = DM_Curl::HTTPGet('user');
					$datum_user = json_decode($data);
		            $template_path = DM_ABSPATH . '/template/datum_single_property.php';
				}else{
	            	if ( $theme_file = locate_template( array ($template_path ) ) ) {   
		                $template_path = $theme_file;
		            } else {
		                $template_path = DM_ABSPATH . '/template/datum_listing.php';
		            }
				}
            }*/
            
           /* if($post_type == $post->ID){
            	$post_type_id = get_query_var('args');
				if($post_type_id != ''){
		            if ( $theme_file = locate_template( array ($template_path ) ) ) { 
		                $template_path = $theme_file;
		            } else {
		                $template_path = DM_ABSPATH . '/template/datum_listing.php';
		            }
				}	
            }*/

            /*if($post_closed == $post->ID){
                $propertyId = get_query_var('args');
                if($propertyId != ''){
                    $id = "property/".$propertyId;
                    $data = DM_Curl::HTTPGet($id);
                    $property = json_decode($data);
                    $single_property = $property->data;

                    $data = DM_Curl::HTTPGet('user');
                    $datum_user = json_decode($data);
                    $template_path = DM_ABSPATH . '/template/datum_closed_single_property.php';
                } else {
                    if ( $theme_file = locate_template( array ($template_path ) ) ) {
                        $template_path = $theme_file;
                    } else {
                        $template_path = DM_ABSPATH . '/template/datum_closed.php';
                    }
                }

            }*/

            /*if($agent_id == $post->ID){
            	
	            if ( $theme_file = locate_template( array ($template_path ) ) ) { 
	                $template_path = $theme_file;
	            } else { 
					$post_name  = get_option('datum_property_listing_id');
                    $dm_post 	= get_post($post_name);

					global $datum_user, $agentDetails;
	            	$agent_id = get_query_var('args');
					if($agent_id == '') {
						wp_redirect(get_home_url($dm_post->post_name));
					}
					$id = "agent/".$agent_id;
					$data = DM_Curl::HTTPGet($id);
		            $agent = json_decode($data);
		            if( $agent->status == 'success') {
						$agentDetails = $agent->data;
					}
					if(empty($agentDetails)) {
						wp_redirect(get_home_url($dm_post->post_name));
					}
		            $single_property = $property->data;
		            $data = DM_Curl::HTTPGet('user');
					$datum_user = json_decode($data);

	                $template_path = DM_ABSPATH . '/template/datum_agent.php';
	            }
            }*/

           /* if($datum_my_listing_page_id == $post->ID){
            	if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {	

		            if ( $theme_file = locate_template( array ($template_path ) ) ) { 
		                $template_path = $theme_file;
		            } else {
			            $data = DM_Curl::HTTPPost('','my-property-list', true, '');
						$myproperty = json_decode($data);
						$mypropertylist = $myproperty->data->data;
		                $template_path = DM_ABSPATH . '/template/my-listing.php';
		            }
            	}else{
            		wp_redirect(get_home_url($dm_post->post_name));
            	}	
            }*/

            /*if($datum_my_favrite_listing_page_id == $post->ID) {
                if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {

                    if ( $theme_file = locate_template( array ($template_path ) ) ) {
                        $template_path = $theme_file;
                    } else {
                        $data = DM_Curl::HTTPPost('','get-favorite-property', true, '');
                        $favritesProperty = json_decode($data);
                        $favritesProperty = $favritesProperty->data->data;
                        $template_path = DM_ABSPATH . '/template/my-favorite-listing.php';
                    }
                }else{
                    wp_redirect(get_home_url($dm_post->post_name));
                }
            }*/

            return $template_path;
		}

		public function get_news_title(){
			global $post;
			echo '<h2>'.get_the_title().'</h2>';
		}

		/**
		 * Called when the plug-in is uninstalled
		 */
		static function uninstall() {
		}
		
		private function check_requirements() {
			global $wp_version;
			if (!version_compare($wp_version, $this->wp_version, '>=')) {
				add_action('admin_notices', 'datum::display_req_notice');
				return false;
			}
			return true;
		}
		
		public function custom_scripts(){
			if (is_admin()) {
			}else{	
				
				
			}
			?>
			<script type="text/javascript">
	    		var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
	    	</script>
			<?php 
		}
		
		public function custom_js(){
			?>
			<?php
		}

		public function save_custom_meta_data(){
			global $post;
		    if($post->post_type == 'news'){
		        if ( $post ) {
		            if(!empty($_POST)){
		            	foreach ($_POST["news"] as $key => $value) {
		            		update_post_meta($post->ID, $key,$value);
		            	}
		            }
		        }
		    }
		}

		public function add_my_rule(){
			$post_name  = get_option('datum_property_listing_id');
			$post_type  = get_option('datum_property_type_id');
			$agent_id  = get_option('datum_agent_id');
            $post_closed = get_option('datum_property_closed_id');
            $datum_verification_page_id  = get_option('datum_verification_page_id');
			$dm_post 	= get_post($post_name);
			$dm_type  = get_post($post_type);
			$agent_id  = get_post($agent_id);
            $closed_property_id  = get_post($post_closed);
            $datum_verification_page_id  = get_post($datum_verification_page_id);

			global $wp;
		    $wp->add_query_var('args');
		    add_rewrite_rule($dm_post->post_name.'/([^/]*)','index.php?pagename='.$dm_post->post_name.'&args=$matches[1]','top');
		    add_rewrite_rule($dm_type->post_name.'/([^/]*)','index.php?pagename='.$dm_type->post_name.'&args=$matches[1]','top');
		    add_rewrite_rule($agent_id->post_name.'/([^/]*)','index.php?pagename='.$agent_id->post_name.'&args=$matches[1]','top');
            add_rewrite_rule($datum_verification_page_id->post_name.'/([^/]*)','index.php?pagename='.$datum_verification_page_id->post_name.'&args=$matches[1]','top');
            add_rewrite_rule($closed_property_id->post_name.'/([^/]*)','index.php?pagename='.$closed_property_id->post_name.'&args=$matches[1]','top');

		    global $wp_rewrite;
		    $wp_rewrite->flush_rules();
		}
		/*public function user_login(){
			$login = new User();
			$response = $login->loginProcess($_POST);
			wp_send_json_success($response);
			wp_die();
		}*/

		public function add_login_logout_register_menu( $items, $args ){
			if ( $args->theme_location == 'primary' ) {
				if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
					$items .= '
						<li class="datum_user_profile"> 
	                      	<div class="half">
	                        	<label for="profile2" class="profile-dropdown">
	                          		<input type="checkbox" id="profile2">
	                          		<span>John Doe</span>
	                          		<img src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
	                          		<label for="profile2"><i class="mdi mdi-menu"></i></label>
	                          		<ul>
			                            <li><a href="#"><i class="mdi mdi-email-outline"></i>Messages</a></li>
			                            <li><a href="#"><i class="mdi mdi-account"></i>Account</a></li>
			                            <li><a href="#"><i class="mdi mdi-settings"></i>Settings</a></li>
			                            <li><a href="#"><i class="mdi mdi-logout"></i>Logout</a></li>
	                         	 	</ul>
	                        	</label>
	                      	</div>
	                    </li>';
				}else{
					$items .= '<li><a data-property_id="" data-popup="login_html" class="datum_modal_toggle datum_model_open"> Login</a></li>';
				}
				return $items;
			}else{
				return $items;
			}
		}


		public function checkValidPage(){

			/*echo '<pre>';
			print_r($post);
			die;*/
		}

		public function add_attribute(){
			return '<a>dff</a>';
		}

		public function addFooterHtml(){
			echo '<div class="datum_modal">
				  	<div class="datum_modal_overlay" id="datum_popup_html"></div>
				  </div>';
		}

		public function userVerification(){

			if(isset($_GET['dmaction']) && $_GET['dmaction'] != ''){
				switch (base64_decode($_GET['dmaction'])) {
					case 'login':
						?>
						<script type="text/javascript">
	                        setTimeout(function(){
	                        	jQuery(document).ready(function(){
	                            	$('.datum_header_login').trigger( "click" );
	                        	});
	                        }, 3000);
	                    </script>
						<?php
						break;
					case 'dashboard_verification':
						$verificationId = base64_decode($_GET['verification_code']);
						if (strpos($verificationId, '/') !== false) {
		                    $verificationId = explode('/', $verificationId)[0];
		                }
		                
		                $data = DM_Curl::HTTPPost(array('token'=>$verificationId), 'find-verification');
		                $data = json_decode($data);
		                if( $data->status == 'success') {
		                    wp_redirect( home_url() );
		                } else{
		                    wp_redirect( get_site_url());
		                }
		                break;
					default:
						// code...
						break;
				}
			}

            if( isset( $_GET['verification'] ) && $_GET['verification'] !="") {
                $verificationId = $_GET['verification'];
                if (strpos($verificationId, '/') !== false) {
                    $verificationId = explode('/', $verificationId)[0];
                }
                
                $data = DM_Curl::HTTPPost(array('token'=>$verificationId), 'find-verification');
                $data = json_decode($data);

                if( $data->status == 'success') {
                    wp_redirect( home_url() );
                } else{
                    wp_redirect( get_site_url());
                }
            }

            if( isset( $_GET['reset_token'] ) && $_GET['reset_token'] !="") {
            	$id = "find/".$_GET['reset_token'];
                $data = DM_Curl::HTTPGet($id);
                $data = json_decode($data);

                if($data->status == 'success') {
                    ?>
                    <a data-property_id="" id="reset_password" data-popup="reset_password" data-main="1" class="datum_modal_toggle datum_model_open" style="display:none;">Reset Password</a>
                    <script type="text/javascript">
                        setTimeout(function(){
                        jQuery(document).ready(function(){
                            $('#reset_password').trigger( "click" );
                            //popupHtml('reset_password');
                            jQuery(document).on('click','#reset_password',function(e){
                                //setTimeout(function(){
                                    popupHtml('reset_password');
                                //}, 2000);
                            });
                        });
                        }, 2000);
                    </script>
                    <?php
                }
            }

        }
	}
}
?>
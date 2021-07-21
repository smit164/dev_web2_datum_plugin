<?php
/**
 * datum setup
 *
 * @package datum
 * @since   3.2.0
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
if (!class_exists('datumPage')) {
		
	class datumPage {
		
		public function __construct() {
			$this->includes();
			$this->init_hooks();
		}

		public function includes() {
			foreach ( $this->pageData() as $key => $value ) {
				include_once DM_ABSPATH . 'includes/page/class-'.$key.'.php';
			}
		}

		public function init_hooks(){

			add_filter( 'template_include', array($this, 'include_template_function'));
		}



		public function include_template_function( $template_path ) {
			global $post;
			global $datum_user;
			$page_name = '';
			foreach ($this->pageData() as $key => $value) {
				$id  = get_option($value);
				if($id == $post->ID){
					if($value == 'datum_my_listing_page_id'){
						$page_name = $key;
						if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
						}else{
							wp_redirect( home_url() );
						}
					}else{
						$page_name = $key;
					}
					 break;
				}else{
					$page_name = '';
				}
			}
			
			$data = json_decode(DM_Curl::HTTPGet('check-plugin-key'));
			if($data->status == 'success'){
				if(!empty($data->user_data)){
					$datum_user = $data->user_data;
				}
			}
			if(isset($page_name) && $page_name != ''){
				return $page_name::output($template_path);
			}else{
				return $template_path;
			}

		}
		public function check_condition(){

		}

		public function pageData(){
			return array(
				'listing' 				=> 'datum_property_listing_id',
				'proerty_type' 			=> 'datum_property_type_id',
				'closed' 				=> 'datum_property_closed_id',
				'agent'        			=> 'datum_agent_id',
				'forgot_password' 		=> 'datum_forgot_password_page_id', 
				'my_listing' 			=> 'datum_my_listing_page_id',
				'my_favourite'			=> 'datum_my_favorite_listing_page_id',
				'terms_and_conditions'	=> 'datum_terms_page_id',
				'OM'							=> 'OM',
			);
		}
	}
}
return new datumPage();
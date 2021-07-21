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
if (!class_exists('datumCreatepage')) {
	/**
	 * 
	 */
	class datumCreatepage 
	{
		
		function __construct()
		{
			$this->init_hooks();
		}

		public function init_hooks(){
			add_action( 'admin_init', array($this,'datum_page_create'));
		}

		public function pageList(){
			return array(
				'listing'			=> 'On Market Listing',
				'proerty_type'		=> 'Property Type',
				'closed'			=> 'Closed Listing',
				'agent'				=> 'Agent',
				'forgot_password'	=> 'Forgot Password',
				'my_listing'		=> 'My Listing',
				'my_favorite'		=> 'My Favorite Listing',
				'terms_and_conditions'	=> 'Terms and conditions',
			);
		}

		
		public function pageID(){
			return array(
				'listing' 				=> 'datum_property_listing_id',
				'proerty_type' 			=> 'datum_property_type_id',
				'closed' 				=> 'datum_property_closed_id',
				'agent'        			=> 'datum_agent_id',
				'forgot_password' 		=> 'datum_forgot_password_page_id', 
				'my_listing' 			=> 'datum_my_listing_page_id',
				'my_favorite'			=> 'datum_my_favorite_listing_page_id',
				'terms_and_conditions'	=> 'datum_terms_page_id',
			);
		}

		public function datum_page_create(){
			$page_id = $this->pageID();
			if ( ! get_option( 'datum_installed' ) ) {
				foreach ($this->pageList() as $key => $value) {	
			        $new_page_id = wp_insert_post( 
			        	array(
				            'post_title'     => $value,
				            'post_type'      => 'page',
				            'post_name'      => $key,
				            'comment_status' => 'closed',
				            'ping_status'    => 'closed',
				            'post_content'   => '',
				            'post_status'    => 'publish',
				            'post_author'    => get_user_by( 'id', 1 )->user_id,
				            'menu_order'     => 0
				        ) 
			        );

			        if ( $new_page_id && ! is_wp_error( $new_page_id ) ){
			            update_post_meta( $new_page_id, '_wp_page_template', 'datum_listing.php' );
			        }
			        update_option( 'datum_installed', true );
			        update_option($page_id[$key],$new_page_id );
			    }
			}

		}


	}
}

return new datumCreatepage();
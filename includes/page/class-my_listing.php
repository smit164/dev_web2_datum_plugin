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
if (!class_exists('my_listing')) {
		
	class my_listing {
		public function output($template_path){

			global $post,$property,$single_property, $datum_user,$mypropertylist, $favritesProperty;
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
			return $template_path;
		}
	}
}
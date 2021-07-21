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
if (!class_exists('proerty_type')) {
		
	class proerty_type {
		public function output($template_path){
			global $post,$property,$single_property, $datum_user,$mypropertylist, $favritesProperty;
			$post_type_id = get_query_var('args');
			if($post_type_id != ''){
	            if ( $theme_file = locate_template( array ($template_path ) ) ) { 
	                $template_path = $theme_file;
	            } else {
	                $template_path = DM_ABSPATH . '/template/datum_listing.php';
	            }
			}
			return $template_path;
		}
	}
}
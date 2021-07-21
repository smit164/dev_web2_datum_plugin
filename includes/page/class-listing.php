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
if (!class_exists('listing')) {
		
	class listing {
		public function output($template_path){
			global $post,$property,$single_property, $datum_user,$mypropertylist, $favritesProperty;
			$propertyId = get_query_var('args');
			if($propertyId != ''){
				$id = "property/".$propertyId;
				$data = DM_Curl::HTTPGet($id);

	            $property = json_decode($data);
	            $single_property = $property->data;
	            
	            $data = DM_Curl::HTTPGet('user');
				$datum_user = json_decode($data);
				if($single_property->ListingStatus == 'Closed'){
	            	$template_path = DM_ABSPATH . '/template/datum_closed_single_property.php';
				}else{
	            	$template_path = DM_ABSPATH . '/template/datum_single_property.php';
				}

			}else{
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
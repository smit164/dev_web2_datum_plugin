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
if (!class_exists('agent')) {
		
	class agent {
		public function output($template_path){
			global $post,$property,$single_property, $datum_user,$mypropertylist, $favritesProperty;
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
	            
	            /*$data = DM_Curl::HTTPGet('user');
				$datum_user = json_decode($data);*/

                $template_path = DM_ABSPATH . '/template/datum_agent.php';
            }
			return $template_path;
		}
	}
}
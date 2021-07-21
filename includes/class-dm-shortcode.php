<?php

function dm_shortcode_social_advanced_callback( $atts ) {

	$shortcode = new DM_Social( $atts );

	return $shortcode->render();

}
add_shortcode( 'dm_social', 'dm_shortcode_social_advanced_callback' );
?>
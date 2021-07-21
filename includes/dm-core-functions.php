<?php
/**
 * datum Template
 *
 * Functions for the templating system.
 *
 * @package  datum\Functions
 * @version  2.5.0
 */

defined( 'ABSPATH' ) || exit;

//include_once DM_ABSPATH . 'includes/dm-core-functions.php';

function dm_help_tip( $tip, $allow_html = false ) {
	if ( $allow_html ) {
		$tip = wc_sanitize_tooltip( $tip );
	} else {
		$tip = esc_attr( $tip );
	}

	return '<span class="datum-help-tip" data-tip="' . $tip . '"></span>';
}
function dm_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'wc_clean', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}
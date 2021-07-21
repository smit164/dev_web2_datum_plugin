<?php
/**
 *
 *
 * @version 1.0.0
 * @package Main
 */
/*
  Plugin Name: Datum
  Plugin URI: 
  Description: Datum Property 
  Author: 
  Author URI: 
  Version: 1.0.0
  Text Domain: 
  License:

*/

 defined( 'ABSPATH' ) || exit;

if ( ! defined( 'DM_PLUGIN_FILE' ) ) {
	define( 'DM_PLUGIN_FILE', __FILE__ );
}

// Include the main datum class.
if ( ! class_exists( 'datum', false ) ) {
	include_once dirname( DM_PLUGIN_FILE ) . '/scssphp/scss.inc.php';
  include_once dirname( DM_PLUGIN_FILE ) . '/includes/class-datum.php';
}

/**
 * Returns the main instance of DM.
 *
 * @since  2.1
 * @return Datum
 */

function DM() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	return datum::instance();
}

// Global for backwards compatibility.
$GLOBALS['datum'] = DM();
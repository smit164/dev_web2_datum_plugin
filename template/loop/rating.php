<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! dm_review_ratings_enabled() ) {
	return;
}

echo dm_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.

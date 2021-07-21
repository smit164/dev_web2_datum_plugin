<?php
/**
 * Briskstar DM_AJAX. AJAX Event Handlers.
 *
 * @class   DM_AJAX
 * @package Briskstar/Classes
 */

defined( 'ABSPATH' ) || exit;


/**
 * DM_Ajax class.
 */
class DM_Social {

	/**
	 * Hook in ajax handlers.
	 */
	public function list() {

		return array(
			'facebook'    => __( 'Facebook', 'dm-social-sharing' ),
			'twitter'     => __( 'Twitter', 'dm-social-sharing' ),
			//'instagram'   => __( 'Instagram', 'dm-social-sharing' ),
			'linkedin'    => __( 'LinkedIn', 'dm-social-sharing' ),
			'email'    	  => __( 'Email', 'dm-social-sharing' ),
			'copy-link'   => __( 'Copy link', 'dm-social-sharing' ),
			/*'googleplus'  => __( 'Google+', 'dm-social-sharing' ),
			'pinterest'   => __( 'Pinterest', 'dm-social-sharing' ),
			'stumbleupon' => __( 'StumbleUpon', 'dm-social-sharing' ),
			'tumblr'      => __( 'Tumblr', 'dm-social-sharing' ),
			'blogger'     => __( 'Blogger', 'dm-social-sharing' ),
			'myspace'     => __( 'Myspace', 'dm-social-sharing' ),
			'delicious'   => __( 'Delicious', 'dm-social-sharing' ),
			'yahoomail'   => __( 'Yahoo Mail', 'dm-social-sharing' ),
			'gmail'       => __( 'Gmail', 'dm-social-sharing' ),
			'newsvine'    => __( 'Newsvine', 'dm-social-sharing' ),
			'digg'        => __( 'Digg', 'dm-social-sharing' ),
			'friendfeed'  => __( 'FriendFeed', 'dm-social-sharing' ),
			'buffer'      => __( 'Buffer', 'dm-social-sharing' ),
			'reddit'      => __( 'Reddit', 'dm-social-sharing' ),
			'vkontakte'   => __( 'VKontakte', 'dm-social-sharing' ),*/
		);
	}

	public function ess_share_link( $network, $media_url = '', $i = 0, $post_link = '', $post_title = '' ) {
		
		global $single_property;
		if ( ! $network ) {
			return;
		}

		$link = '';

		if ( '' !== $post_link ) {
			$permalink = $post_link;
		} else {
			$permalink = ( class_exists( 'WooCommerce' ) && is_checkout() || is_front_page() ) ? get_bloginfo( 'url' ) : get_permalink();

			if ( class_exists( 'BuddyPress' ) && is_buddypress() ) {
				$permalink = bp_get_requested_url();
			}
		}

		$permalink = rawurlencode( $permalink );

		if ( '' !== $post_title ) {
			$title = $post_title;
		} else {
			$title = class_exists( 'WooCommerce' ) && is_checkout() || is_front_page() ? get_bloginfo( 'name' ) : get_the_title();
		}

		if(!empty($single_property)){
			$title = $single_property->Name;
			$permalink = getDMProperyURL();	
		}

		$title = rawurlencode( wp_strip_all_tags( html_entity_decode( $title, ENT_QUOTES, 'UTF-8' ) ) );

		$twitter_username = get_option( 'dm_social_sharing_twitter_username' );
		
		switch ( $network ) {
			case 'facebook':
				$link = sprintf( 'http://www.facebook.com/sharer.php?u=%1$s&t=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'twitter':
				$link = sprintf( 'http://twitter.com/share?text=%2$s&url=%1$s&via=%3$s', esc_attr( $permalink ), esc_attr( $title ), ! empty( $twitter_username ) ? esc_attr( $twitter_username ) : get_bloginfo( 'name' ) );
				break;
			case 'googleplus':
				$link = sprintf( 'https://plus.google.com/share?url=%1$s&t=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'Instagram':
				$link = sprintf( 'https://plus.google.com/share?url=%1$s&t=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'email':
				$link = 'mailto:smit.1stop@gmail.com?subject='.esc_attr( $permalink );
				break;
			case 'copy-link':
				$link = get_permalink().''.$single_property->id;;
				break;
			case 'pinterest':
				$link = $media_url ? sprintf( 'http://www.pinterest.com/pin/create/button/?url=%1$s&media=%2$s&description=%3$s', esc_attr( $permalink ), esc_attr( urlencode( $media_url ) ), esc_attr( $title ) ) : '#';
				break;
			case 'stumbleupon':
				$link = sprintf( 'http://www.stumbleupon.com/badge?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'tumblr':
				$link = sprintf( 'https://www.tumblr.com/share?v=3&u=%1$s&t=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'blogger':
				$link = sprintf( 'https://www.blogger.com/blog_this.pyra?t&u=%1$s&n=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'myspace':
				$link = sprintf( 'https://myspace.com/post?u=%1$s', esc_attr( $permalink ) );
				break;
			case 'delicious':
				$link = sprintf( 'https://delicious.com/post?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'amazon':
				$link = sprintf( 'http://www.amazon.com/gp/wishlist/static-add?u=%1$s&t=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'printfriendly':
				$link = sprintf( 'http://www.printfriendly.com/print?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'yahoomail':
				$link = sprintf( 'http://compose.mail.yahoo.com/?body=%1$s', esc_attr( $permalink ) );
				break;
			case 'gmail':
				$link = sprintf( 'https://mail.google.com/mail/u/0/?view=cm&fs=1&su=%2$s&body=%1$s&ui=2&tf=1', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'aol':
				$link = sprintf( 'http://webmail.aol.com/Mail/ComposeMessage.aspx?subject=%2$s&body=%1$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'newsvine':
				$link = sprintf( 'http://www.newsvine.com/_tools/seed&save?u=%1$s&h=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'hackernews':
				$link = sprintf( 'https://news.ycombinator.com/submitlink?u=%1$s&t=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'evernote':
				$link = sprintf( 'http://www.evernote.com/clip.action?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'digg':
				$link = sprintf( 'http://digg.com/submit?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'livejournal':
				$link = sprintf( 'http://www.livejournal.com/update.bml?subject=%2$s&event=%1$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'friendfeed':
				$link = sprintf( 'http://friendfeed.com/?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'buffer':
				$link = sprintf( 'https://bufferapp.com/add?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'reddit':
				$link = sprintf( 'http://www.reddit.com/submit?url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
			case 'vkontakte':
				$link = sprintf( 'http://vk.com/share.php?url=%1$s', esc_attr( $permalink ) );
				break;
			case 'linkedin':
				$link = sprintf( 'http://www.linkedin.com/shareArticle?mini=true&url=%1$s&title=%2$s', esc_attr( $permalink ), esc_attr( $title ) );
				break;
		}

		return $link;
	}

	public function render(){

		
		foreach ($this->list() as $key => $value) {
			if($key == 'copy-link'){
				echo '<a id="copy_link" data-link="'.$this->ess_share_link($key).'"  href="javascript:void(0)"><img src="'.plugins_url().'/datum/images/icons/social/'.$key.'.png"></a>';
			}else if($key == 'email'){
				echo '<a href="'.$this->ess_share_link($key).'"><img src="'.plugins_url().'/datum/images/icons/social/'.$key.'.png"></a>';
			}else{

				echo '<a target="_blank" class="ess-social-share" href="'.$this->ess_share_link($key).'"><img src="'.plugins_url().'/datum/images/icons/social/'.$key.'.png"></a>';
			}
		}
	}
}
?>
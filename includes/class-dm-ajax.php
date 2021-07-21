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
class DM_AJAX {

	/**
	 * Hook in ajax handlers.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'define_ajax' ), 0 );
		add_action( 'template_redirect', array( __CLASS__, 'do_wc_ajax' ), 0 );
		self::add_ajax_events();
	}

	/**
	 * Get DM Ajax Endpoint.
	 *
	 * @param string $request Optional.
	 *
	 * @return string
	 */
	public static function get_endpoint( $request = '' ) {
		return esc_url_raw( apply_filters( 'woocommerce_ajax_get_endpoint', add_query_arg( 'wc-ajax', $request, remove_query_arg( array( 'remove_item', 'add-to-cart', 'added-to-cart', 'order_again', '_wpnonce' ), home_url( '/', 'relative' ) ) ), $request ) );
	}

	/**
	 * Set DM AJAX constant and headers.
	 */
	public static function define_ajax() {
		// phpcs:disable
		if ( ! empty( $_GET['wc-ajax'] ) ) {
			wc_maybe_define_constant( 'DOING_AJAX', true );
			wc_maybe_define_constant( 'DM_DOING_AJAX', true );
			if ( ! WP_DEBUG || ( WP_DEBUG && ! WP_DEBUG_DISPLAY ) ) {
				@ini_set( 'display_errors', 0 ); // Turn off display_errors during AJAX events to prevent malformed JSON.
			}
			$GLOBALS['wpdb']->hide_errors();
		}
		// phpcs:enable
	}

	/**
	 * Send headers for DM Ajax Requests.
	 *
	 * @since 2.5.0
	 */
	private static function wc_ajax_headers() {
		if ( ! headers_sent() ) {
			send_origin_headers();
			send_nosniff_header();
			wc_nocache_headers();
			header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
			header( 'X-Robots-Tag: noindex' );
			status_header( 200 );
		} elseif ( Constants::is_true( 'WP_DEBUG' ) ) {
			headers_sent( $file, $line );
			trigger_error( "wc_ajax_headers cannot set headers - headers already sent by {$file} on line {$line}", E_USER_NOTICE ); // @codingStandardsIgnoreLine
		}
	}

	/**
	 * Check for DM Ajax request and fire action.
	 */
	public static function do_wc_ajax() {
		global $wp_query;

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( ! empty( $_GET['wc-ajax'] ) ) {
			$wp_query->set( 'wc-ajax', sanitize_text_field( wp_unslash( $_GET['wc-ajax'] ) ) );
		}

		$action = $wp_query->get( 'wc-ajax' );

		if ( $action ) {
			self::wc_ajax_headers();
			$action = sanitize_text_field( $action );
			do_action( 'wc_ajax_' . $action );
			wp_die();
		}
		// phpcs:enable
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		/**
		 * Toggle payment gateway on or off via AJAX.
		 *
		 * @since 3.4.0
		 */
		$ajax_events = array(
			'property_list',
			'sign_up',
			'sing_in',
			'update_profile',
			'loginFrm',
			'otp_verify',
			'otp_resend',
			'forgot_password',
			'popuphtml',
			'document_vault_structure',
			'dd_success',
			'dd_request',
			'datum_logout',
			'changed_password',
            'request_info',
            'read_property_name',
            'resend_email',
            'update_email',
            'send_otp',
            'reset_password',
            'press_release',
            'contact_form',
            'share_property',
            'showing_user_detalis',
		);

		foreach ( $ajax_events as $ajax_event ) {
			add_action('wp_ajax_'.$ajax_event,array( __CLASS__, $ajax_event ));
			add_action( 'wp_ajax_nopriv_'.$ajax_event, array( __CLASS__, $ajax_event ) );
		}
	}

	public function property_list(){

        global $property_post, $datum_user;
        $advance_search_type = "";
        if(isset($_POST['property_type']) && !empty($_POST['property_type']) ){
            $advance_search_type = $_POST['property_type'];
        	$_POST['property_type'] = json_encode($_POST['property_type']);
        }else{
        	$_POST['property_type'] = '';
        	$_POST['property_type'] = '';
        }

        if ( isset($_POST['advance_search']) && $_POST['advance_search'] == "yes") {
            set_site_transient( 'advance_search_types', $advance_search_type, 86400 );
        } else {
            set_site_transient( 'advance_search_types', "", 86400 );
        }

        $nextPage = '';
        if(isset($_POST['next_page']) && $_POST['next_page'] !='' ){
            $nextPage = '?page='.$_POST['next_page'];
        }


        if($nextPage != '') {
            $data = DM_Curl::HTTPPost($_POST,'property'.$nextPage);
        } else {
            $data = DM_Curl::HTTPPost($_POST,'property');
        }
		$property = json_decode($data);

        $nextPageId = '';
		if($property->data->next_page_url != null && $property->data->next_page_url != '') {
		    $queryParams = parse_url($property->data->next_page_url, PHP_URL_QUERY);
            $queryParams = explode('=', $queryParams);
            $nextPageId = $queryParams[1];
        }
		$result = '';
		$marker = array();
		if(!empty($property->data->data)){

			if($property->data->current_page == $property->data->last_page){
				$view_more = true;
			}else{
				$view_more = false;
			}
			ob_start();
            foreach ($property->data->data as $key => $property_post) {
            	global $single_property;
            	$single_property = $property_post;
            	$arr_askingprice = getDMPropertyAskingPrice();
				/*if ($rowval['is_unpriced'] == 1) {
					$arr_askingprice = 'Unpriced';
				}*/
				$lat = getDMPropertyLatitude();
				$log = getDMPropertyLongitude();

            	if($lat != '' &&  $log != ''){
	            	$marker[] = array(
	                    'lat' 	=> getDMPropertyLatitude(),
	                    'log'   => getDMPropertyLongitude(),
	                    'title' => getDMPropertyName(),
	                    'properyurl'	=> getDMProperyURL(),
	                    'featured_image'	=> getDMPropertyMarkerListImage(),
	                    'p_status'	=> getDMPropertyListingStatusOnly(),
	                    'p_price'	=> getDMPropertyAskingPrice(),
	                    'addr'		=> getDMPropertyCity() . ' '.getDMPropertyState(),
	                    'p_type'	=> getDMPropertyPropertyStatus(),

	                );
            	}
                include DM_ABSPATH . '/template/content-property.php';
            }
            $marker_data = json_encode($marker);
            $result = ob_get_clean();
        	$response = array(
	            'type' 	=> 'success',
	            'html'	=> $result,
	            'view_more' => $view_more,
	            'marker_data'	=> $marker,
                'next_page_id' => $nextPageId
			);
        }else{
        	ob_start();
        	include DM_ABSPATH . '/template/loop/no-products-found.php';
        	$response = array(
	            'type' 	=> 'success',
	            'html'	=> ob_get_clean(),
	            'view_more' => true,
	            'marker_data'	=> $marker,
			);
        }

		wp_send_json_success($response);
		wp_die();
	}

	public function sing_in(){


		if(!empty($_POST['markets'])){
			$_POST['markets'] = implode(',', $_POST['markets']);
		}
		if(!empty($_POST['cell_phone'])){
			$_POST['cell_phone'] = str_replace('-', '', $_POST['cell_phone']);
		}
		if(!empty($_POST['mobile_phone'])){
			$_POST['mobile_phone'] = str_replace('-', '', $_POST['mobile_phone']);
		}
		if(!empty($_POST['PropetyType'])){
			$_POST['PropetyType'] = json_encode($_POST['PropetyType']);
		}else{
			$_POST['PropetyType'] = '';
		}
		if(!empty($_POST['PeferredMarketType'])){
			$_POST['PeferredMarketType'] = json_encode($_POST['PeferredMarketType']);
		}else{
			$_POST['PeferredMarketType'] = '';
		}
		if(!empty($_POST['InvestmentStraragy'])){
			$_POST['InvestmentStraragy'] = json_encode($_POST['InvestmentStraragy']);
		}else{
			$_POST['InvestmentStraragy'] = '';
		}
		if(!empty($_POST['ReturnMetrics'])){
			$_POST['ReturnMetrics'] = json_encode($_POST['ReturnMetrics']);
		}else{
			$_POST['ReturnMetrics'] = '';
		}
		if(!empty($_POST['PrefferedDealSize'])){
			$_POST['PrefferedDealSize'] = json_encode($_POST['PrefferedDealSize']);
		}else{
			$_POST['PrefferedDealSize'] = '';
		}

		if(!empty($_POST['state_select'])){
			$_POST['state'] = $_POST['state_select'];
		}else if(!empty($_POST['state_text'])){
			$_POST['state'] = $_POST['state_text'];
		}else{
			$_POST['state'] = '';
		}
		$step = $_POST['step'];


		if(isset($_FILES['avatar'])){
			$_POST['avatar'] = $_FILES['avatar'];
		}

		$data = DM_Curl::HTTPPost($_POST,'signup');

		$user = json_decode($data);


		$txt =  $data;
 		$myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

		if($user->status == 'success'){
			$response = array(
	            'type' 	=> 'success',
	            'html'	=> $user->message,
			);
			if($step == 2 ){
				global $datum_user;
				$datum_user = $user->data;
				ob_start();
				include DM_ABSPATH . '/template/auth/verify.php';
				$response['html'] = ob_get_clean();
			}
		}else{

			$response = errorcheck($user);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function update_profile(){

        if(!empty($_POST['markets'])){
            $_POST['markets'] = implode(',', $_POST['markets']);
        }
        if(!empty($_POST['cell_phone'])){
            $_POST['cell_phone'] = str_replace('-', '', $_POST['cell_phone']);
        }
        if(!empty($_POST['mobile_phone'])){
            $_POST['mobile_phone'] = str_replace('-', '', $_POST['mobile_phone']);
        }
        if(!empty($_POST['PropetyType'])){
            $_POST['PropetyType'] = json_encode($_POST['PropetyType']);
        }else{
            $_POST['PropetyType'] = '';
        }
        if(!empty($_POST['PeferredMarketType'])){
            $_POST['PeferredMarketType'] = json_encode($_POST['PeferredMarketType']);
        }else{
            $_POST['PeferredMarketType'] = '';
        }
        if(!empty($_POST['InvestmentStraragy'])){
            $_POST['InvestmentStraragy'] = json_encode($_POST['InvestmentStraragy']);
        }else{
            $_POST['InvestmentStraragy'] = '';
        }
        if(!empty($_POST['ReturnMetrics'])){
            $_POST['ReturnMetrics'] = json_encode($_POST['ReturnMetrics']);
        }else{
            $_POST['ReturnMetrics'] = '';
        }
        if(!empty($_POST['PrefferedDealSize'])){
            $_POST['PrefferedDealSize'] = json_encode($_POST['PrefferedDealSize']);
        }else{
            $_POST['PrefferedDealSize'] = '';
        }

        if(!empty($_POST['state_select'])){
            $_POST['state'] = $_POST['state_select'];
        }else if(!empty($_POST['state_text'])){
            $_POST['state'] = $_POST['state_text'];
        }else{
            $_POST['state'] = '';
        }
        $step = $_POST['step'];


        if(isset($_FILES['avatar'])){
            $_POST['avatar'] = $_FILES['avatar'];
        }

		$data = DM_Curl::HTTPPost($_POST,'profile');

		$user = json_decode($data);

		if($user->status == 'success'){
			$response = array(
	            'type' 	=> 'success',
	            'html'	=> $user->message,
			);
			if($step == 2 ){
				$response['user_id'] = $user->data->id;
			}
		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> $user->errors
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function sign_up(){

		$data = DM_Curl::HTTPGet('login',$_POST);

		$user = json_decode($data);
		if($user->status == 'success'){
			$response = array(
	            'type' 	=> 'success',
	            'html'	=> $user->message
			);
		}else{
			$response = array(
	            'type' 	=> 'failed',
	            'html'	=> $user->message
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	/**
	 * Toggle payment gateway on or off via AJAX.
	 *
	 * @since 3.4.0
	 */

	public function loginFrm(){
		if($_POST['email'] != '' && $_POST['password'] != ''){
			$data = DM_Curl::HTTPPost($_POST,'login');
			$user = json_decode($data);
			global $datum_user;
			$favoriteFlag = [];
			$favoriteFlag['favrite'] = '';
			$favoriteFlag['remove_favrite'] = '';
			$favoriteFlag['popup'] = true;
			if(empty($user)){
				$response = array(
		            'type' 	=> 'failure',
		            'html'	=> array('error_login' =>'Some things went wrong')
				);
			}else{
				if($user->status == 'failed'){
					$response = array(
			            'type' 	=> 'failure',
			            'html'	=> array('error_login' =>$user->message)
					);
				}else{
					$datum_user = $user->data->user;
					if(!$user->data->user->IsAccountVerified){
						ob_start();
						include DM_ABSPATH . '/template/auth/verify.php';
						$response = array(
				            'type' 	=> 'success',
				            'html'	=> ob_get_clean(),
				            'IsAccountVerified'	=> 0,
						);
					}else if($user->isNextUpdateDate){
						global $criteria;
						$upload 	= wp_upload_dir();
						$cookie_name 	= "access_token";
						$cookie_value 	= $user->access_token;
						
						$data_new 		= DM_Curl::HTTPGet('acquisitioncriteria');
						$criteria 		= json_decode($data_new);

						setcookie($cookie_name, $cookie_value, time() + 86400, "/");
						ob_start();
						include DM_ABSPATH . '/template/auth/1031updateprofile.php';
						$response = array(
				            'type' 				=> 'success',
				            'html'				=> ob_get_clean(),
				            'isNextUpdateDate'	=> 1,
						);
					}else if($user->IsContactCreatedByDashboard  != '' && $user->IsupdateDashbord == ''){
						global $criteria;
						$upload 	= wp_upload_dir();
						$cookie_name 	= "access_token";
						$cookie_value 	= $user->access_token;
						
						$data_new 		= DM_Curl::HTTPGet('acquisitioncriteria');
						$criteria 		= json_decode($data_new);

						setcookie($cookie_name, $cookie_value, time() + 86400, "/");
						ob_start();
						include DM_ABSPATH . '/template/auth/1031updateprofile.php';
						$response = array(
				            'type' 				=> 'success',
				            'html'				=> ob_get_clean(),
				            'isNextUpdateDate'	=> 1,
						);
					}else{
						$upload 	= wp_upload_dir();
						$cookie_name 	= "access_token";
						$cookie_value 	= $user->access_token;
						setcookie($cookie_name, $cookie_value, time() + 86400, "/");

						///$pr_user = $datum_user;

						global $single_property,$datum_user;
						$property_id = $_POST['property_id'];
						$id = "property/".$property_id;
						$data = DM_Curl::HTTPGet($id,array(),$user->access_token);
						$property = json_decode($data);
		           		$single_property = $property->data;
						$data = DM_Curl::HTTPGet('user',array(),$user->access_token);
						$datum_user = json_decode($data);

						if(isset($_POST['type']) && $_POST['type'] == 'press_release'){
							
							if($user->press_release->IsPressReleaseFile == 1){

								$response = array(
									'type' 	=> 'success',
									'press_release_type'	=> 1,
									'is_press_release'	=> 1,
									'pp_link'	=> home_url('') .'/wp-content/uploads/press_release/'.$user->press_release->PropertyID.'/'.$user->press_release->PressReleaseFile,
									'pp_name'	=> $user->press_release->PressReleaseFile,
								);
							}else{
								$response = array(
									'type' 	=> 'success',
									'press_release_type'	=> 1,
									'is_press_release'	=> 0,
									'pp_link'	=> $user->press_release->PressReleaseLink,
								);
							}
						}else{
							if(isset($_POST['favProperty']) && $_POST['favProperty'] == 'favProperty') {
								$favoriteArray = array(
									'user_id' => $datum_user->Id,
									'property_id' => getDMPropertyId()
								);
								$favorite = DM_Curl::HTTPPost($favoriteArray,'favorite', $user->access_token);
								$favorite = json_decode($favorite);
								if(isset($_POST['favProperty']) && $_POST['favProperty'] != '') {
									$favoriteFlag['property_id'] = $property_id;
								}
								$favoritesStatus = '';
								if($favorite->status == 'success') {
									if( $favorite->data->favorite ) {
										$favoriteFlag['favrite'] = true;
										$favoriteFlag['remove_favrite'] = false;
										$favoriteFlag['popup'] = false;
									} else {
										$favoriteFlag['favrite'] = false;
										$favoriteFlag['remove_favrite'] = true;
										$favoriteFlag['popup'] = false;
									}
								}
								$response = array(
									'type' 	=> 'success',
									'html'	=> ob_get_clean(),
									'IsAccountVerified'	=> 1,
									'favorite' => $favoriteFlag
								);
							} else {
								$postData = array('property_id' => $property_id );
								$checkCaSign = DM_Curl::HTTPPost($postData,'check-ca-sign', true, $user->access_token);
								$checkCaSign = json_decode($checkCaSign);

								ob_start();
                                if( !empty( $checkCaSign->data ) && $checkCaSign->data != null ) {
	                            //if( !empty( $checkCaSign->data ) && $checkCaSign->data->docuement_role == 'OM') {
                                    if($single_property->documentaccess == "Pending") {
                                        include DM_ABSPATH . '/template/auth/om-message-popup.php';
                                    } elseif ($single_property->documentaccess == "Rejected") {
                                        include DM_ABSPATH . '/template/auth/om-reject-message.php';
                                    } else {
                                        if($single_property->documentvaultomaccess) {
                                            $documenttype = 'Offering Memorandum';
                                            include DM_ABSPATH . '/template/auth/document_vault_structure.php';
                                        } else {
                                            $om = DM_Curl::HTTPPost(array('property_id'=>$property_id),'check-om-access', true, $user->access_token);
                                            $om = json_decode($om);
                                            if($om->status == "success" && $om->data->access) {
                                                include DM_ABSPATH . '/template/auth/om-message-popup.php';
                                            } else {
                                                include DM_ABSPATH . '/template/auth/agent-not-found.php';
                                            }
                                        }
                                    }

								} else {
									include DM_ABSPATH . '/template/auth/agreement.php';
								}
								$response = array(
									'type' 	=> 'success',
									'html'	=> ob_get_clean(),
									'IsAccountVerified'	=> 1,
								);
							}
						}

					}
				}
			}
		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> array('error_login' =>'Please provide a email or password.')
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function otp_verify($value='')
	{
		$data = DM_Curl::HTTPPost($_POST,'verify-email-otp');
		$user = json_decode($data);

		if($user->status == 'success'){
			$response = array(
	            'type' 	=> 'success',
			);
		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> $user->message
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function otp_resend(){
		$data = DM_Curl::HTTPPost($_POST,'resend-email-otp');
		$user = json_decode($data);

		if($user->status == 'success'){
			$response = array(
	            'type' 	=> 'success',
			);
		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> $errors
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function forgot_password(){
		$data = DM_Curl::HTTPPost($_POST,'forgot-password');
		$user = json_decode($data);
		if($user->status == 'success'){
			$response = array(
	            'type' 	=> 'success',
	            'html'	=> $user->message,
			);
		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> $user->message
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function popuphtml(){
		ob_start();

		$favoriteFlag = [];
		$favoriteFlag['favrite'] = '';
		$favoriteFlag['remove_favrite'] = '';
		$favoriteFlag['popup'] = true;
		$favoriteFlag['login'] = false;

		if($_POST['popuphtml']){
			switch ($_POST['popuphtml']) {
				case 'login_html':
					//$_COOKIE['access_token'] = '';
					if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
						global $datum_user, $single_property, $documenttype;
						$property_id = $_POST['property_id'];
						$id = "property/".$property_id;
						$data = DM_Curl::HTTPGet($id);

						$property = json_decode($data);
                        if($property->status != "failed") {
                            $single_property = $property->data;

                            $data = DM_Curl::HTTPGet('user');
                            $datum_user = json_decode($data);
                            if( $datum_user->status == 'failed' ) {
                                include DM_ABSPATH . '/template/auth/login.php';
                            } else if($datum_user->isNextUpdateDate != ''){
                            	include DM_ABSPATH . '/template/auth/1031updateprofile.php';
                            }else {
                                $postData = array('property_id' => $property_id );

                                $checkCaSign = DM_Curl::HTTPPost($postData,'check-ca-sign');

                                $checkCaSign = json_decode($checkCaSign);

                                if( !empty( $checkCaSign->data ) && $checkCaSign->data != null ) {
                                //if( !empty( $checkCaSign->data ) && $checkCaSign->data->docuement_role == 'OM') {

                                    if($single_property->documentaccess == "Pending") {
                                        include DM_ABSPATH . '/template/auth/om-message-popup.php';
                                    } elseif ($single_property->documentaccess == "Rejected") {
                                        include DM_ABSPATH . '/template/auth/om-reject-message.php';
                                    } else {
                                        if($single_property->documentvaultomaccess) {
                                            $documenttype = 'Offering Memorandum';
                                            include DM_ABSPATH . '/template/auth/document_vault_structure.php';
                                        } else {
                                            $om = DM_Curl::HTTPPost(array('property_id'=>$property_id),'check-om-access');
                                            $om = json_decode($om);

                                            if($om->status == "success" && $om->data->access) {
                                                include DM_ABSPATH . '/template/auth/om-message-popup.php';
                                            } else {
                                                include DM_ABSPATH . '/template/auth/agent-not-found.php';
                                            }
                                        }
                                    }

                                } else {
                                    include DM_ABSPATH . '/template/auth/agreement.php';
                                }
                            }
                        } else {
                            $favoriteFlag['popup'] = false;
                            $favoriteFlag['reload'] = true;
                        }
					}else{
						global $single_property;
						$property_id = $_POST['property_id'];
						$id = "property/".$property_id;
						$data = DM_Curl::HTTPGet($id);
						$property = json_decode($data);
		           		$single_property = $property->data;

						include DM_ABSPATH . '/template/auth/login.php';
					}
					break;
				case 'register_html':
					global $criteria;
					//$_COOKIE['access_token'] = '';
					$data_new 		= DM_Curl::HTTPGet('acquisitioncriteria');
					$criteria 		= json_decode($data_new);

					if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
						global $datum_user;
						$data = DM_Curl::HTTPGet('user');
						$datum_user = json_decode($data);
						include DM_ABSPATH . '/template/auth/updateprofile.php';
					}else{
						include DM_ABSPATH . '/template/auth/register.php';
						//include DM_ABSPATH . '/template/auth/verify.php';
					}
					break;
				case 'unexecuted':
					global $wpdb, $datum_user, $single_property, $documenttype;
					$property_id = $_POST['property_id'];

					$id = "property/".$property_id;
					$data = DM_Curl::HTTPGet($id);
					$property = json_decode($data);
					$single_property = $property->data;

					$data = DM_Curl::HTTPGet('user');
					$datum_user = json_decode($data);

					$documenttype = 'Public';

					$postData = array('property_id' => 2 );
					$checkCaSign = DM_Curl::HTTPPost($postData,'check-ca-sign');
					include DM_ABSPATH . '/template/auth/document_vault_structure.php';
					break;

				case 'forgot':
					include DM_ABSPATH . '/template/auth/forgot.php';
					break;
				case 'due_diligence':
						global $wpdb, $datum_user, $single_property, $documenttype;
						$property_id = $_POST['property_id'];
						$id = "property/".$property_id;
						$data = DM_Curl::HTTPGet($id);
						$property = json_decode($data);
						$single_property = $property->data;
						$data = DM_Curl::HTTPGet('user');
						$datum_user = json_decode($data);
						$documenttype = 'Due Diligence';

						$postData = array('property_id' => $property_id );
						$ddRequest = DM_Curl::HTTPPost($postData,'check-dd-request');
                        $ddRequest = json_decode($ddRequest);
                        if( $ddRequest->status == "success" ) {
                            if(!empty($ddRequest->data)) {
                                if($ddRequest->data->duediligence_reqeust_status == "Pending") {
                                    include DM_ABSPATH . '/template/auth/dd_success.php';
                                } elseif ($ddRequest->data->duediligence_reqeust_status == "Approved") {
                                    include DM_ABSPATH . '/template/auth/document_vault_structure.php';
                                } elseif ($ddRequest->data->duediligence_reqeust_status == "Rejected") {
                                    include DM_ABSPATH . '/template/auth/dd_rejected.php';
                                }
                            } else {
                                include DM_ABSPATH . '/template/auth/due_diligence.php';
                            }
                        }
						break;
				case 'favorite_popup':
						global $wpdb, $single_property, $datum_user;
						$data = DM_Curl::HTTPGet('user');
						$datum_user = json_decode($data);
						$property_id = $_POST['property_id'];

						if( $datum_user->status == 'failed' ) {
							include DM_ABSPATH . '/template/auth/login.php';
							$favoriteFlag['favrite'] = '';
							$favoriteFlag['remove_favrite'] = '';
							$favoriteFlag['popup'] = true;
							$favoriteFlag['login'] = true;
							if(isset($_POST['favProperty']) && $_POST['favProperty'] != '') {
								$favoriteFlag['favProperty'] = $_POST['favProperty'];
                                $favoriteFlag['property_id'] = $property_id;
							}
                            $favoriteFlag['favProperty'] = 'property';
                            $favoriteFlag['property_id'] = $property_id;
						} else {
							if(isset( $_POST['property_id'] ) && $_POST['property_id'] != '') {
								if(isset($_POST['favProperty']) && $_POST['favProperty'] != '') {
									$favoriteFlag['property_id'] = $_POST['property_id'];
								}
								$favoriteArray = array(
									'user_id' => $datum_user->Id,
									'property_id' => $_POST['property_id']
								);

								$favorite = DM_Curl::HTTPPost($favoriteArray,'favorite');
								$favorite = json_decode($favorite);

								if($favorite->status == 'success') {
									if( $favorite->data->favorite ) {
										$favoriteFlag['favrite'] = true;
										$favoriteFlag['remove_favrite'] = '';
										$favoriteFlag['popup'] = false;
                                        $favoriteFlag['property_id'] = $_POST['property_id'];
									} else {
										$favoriteFlag['favrite'] = '';
										$favoriteFlag['remove_favrite'] = true;
										$favoriteFlag['popup'] = false;
                                        $favoriteFlag['property_id'] = $_POST['property_id'];
									}
								}

							}
						}
					break;
				case 'favorite_my_listing':
					global $wpdb, $single_property, $datum_user;
					$data = DM_Curl::HTTPGet('user');
					$datum_user = json_decode($data);
					$favoriteArray = array(
						'user_id' 		=> getDMUserId(),
						'property_id' 	=> $_POST['property_id']
					);

					$favorite = DM_Curl::HTTPPost($favoriteArray,'favorite');
					$favorite = json_decode($favorite);
					if( $favorite->status == 'success') {
						$data = DM_Curl::HTTPPost('','get-favorite-property', true, '');
	                    $favritesProperty = json_decode($data);
	                    $favritesProperty = $favritesProperty->data->data;
	                    include DM_ABSPATH . '/template/mylisting/favritesProperty.php';

					}else{
						$response = array(
				            'type' 	=> 'failure',
				            'html'	=> $favorite->errors
						);
					}

					break;
				case 'advanced_search':
					global $wpdb, $property_type_subtyep, $property_status, $property_tenancy, $property_building_class, $property_location;
					$property_commons = DM_Curl::HTTPGet('property_commons');
					$property_commons = json_decode($property_commons);

					if( $property_commons->status == 'success') {
						$property_type_subtyep = $property_commons->data->property_type_sub;
						$property_status = $property_commons->data->property_status;
						$property_tenancy = $property_commons->data->property_tenancy;
						$property_building_class = $property_commons->data->property_building_class;
						$property_location = $property_commons->data->property_location;
					}
					$data_new 		= DM_Curl::HTTPGet('acquisitioncriteria');
					$criteria 	= json_decode($data_new);

					include DM_ABSPATH . '/template/advanced_search.php';
					break;
				case 'change_password_popup':
					include DM_ABSPATH . '/template/auth/change-password.php';
					break;
                case 'request_info':
                    global $wpdb, $single_property;
                    $property_id = $_POST['property_id'];
                    $id = "property/".$property_id;
                    $data = DM_Curl::HTTPGet($id);
                    $property = json_decode($data);
                    $single_property = $property->data;
                    include DM_ABSPATH . '/template/request_info.php';
                    break;
                case 'reset_password':
                    include DM_ABSPATH . '/template/auth/reset-password.php';
                    break;
                case 'contact_from':
                	global $single_property;
                	$id = "property/".$_POST['property_id'];
					$data = DM_Curl::HTTPGet($id);
					$property = json_decode($data);
					$single_property = $property->data;
                    include DM_ABSPATH . '/template/auth/contact_from.php';
                	break;
                case 'share_property':
                	global $single_property;
                	$id = "property/".$_POST['property_id'];
					$data = DM_Curl::HTTPGet($id);
					$property = json_decode($data);
					$single_property = $property->data;
                    include DM_ABSPATH . '/template/auth/share_property.php';
                	break;
				default:
					# code...
					break;
			}
		}
		$response = array(
            'type' 	=> 'success',
            'html'	=> ob_get_clean(),
            'favorite' => $favoriteFlag,
		);
		wp_send_json_success($response);
		wp_die();
	}

	public function document_vault_structure(){
		global $wpdb, $datum_user, $single_property, $documenttype;
		$property_id = $_POST['property_id'];
		$id = "property/".$property_id;
		$data = DM_Curl::HTTPGet($id);
		$property = json_decode($data);
		$single_property = $property->data;
		$data = DM_Curl::HTTPGet('user');
		$datum_user = json_decode($data);
		$documenttype = $_POST['documenttype'];
		$documenttype = $documenttype;

        ob_start();
        if($documenttype == "Offering Memorandum") {
            if($single_property->documentaccess == "Pending") {
                include DM_ABSPATH . '/template/auth/om-message-popup.php';
            } elseif ($single_property->documentaccess == "Rejected") {
                include DM_ABSPATH . '/template/auth/om-reject-message.php';
            } else {
                if( $single_property->documentvaultomaccess ) {
                    include DM_ABSPATH . '/template/auth/document_vault_structure.php';
                } else {
                    $om = DM_Curl::HTTPPost(array('property_id'=>$property_id),'check-om-access');
                    $om = json_decode($om);
                    if($om->status == "success" && $om->data->access) {
                        include DM_ABSPATH . '/template/auth/om-message-popup.php';
                    } else {
                        include DM_ABSPATH . '/template/auth/agent-not-found.php';
                    }
                }
            }

        } else {
            include DM_ABSPATH . '/template/auth/document_vault_structure.php';
        }
		$response = array(
            'type' 	=> 'success',
            'html'	=> ob_get_clean(),
		);
		wp_send_json_success($response);
		wp_die();
	}

	public function dd_request() {
		$property_id = $_POST['property_id'];
		$send_dd = $_POST['send_dd'];
		$postData = array(
			'property_id' => $property_id,
			'docuement_role' => 'Due Diligence'
		);

		$data = DM_Curl::HTTPPost($postData,'send-dd-request');

		$data = json_decode($data);
		if( $data->status == 'success') {
			$response = array(
				'type' 	=> 'success',
				'html'	=> ob_get_clean(),
                'message' => $data->message,
			);
			wp_send_json_success($response);
			wp_die();
		} else {
            $response = array(
                'type' 	=> 'failed',
                'html'	=> $data->message,
                'message' => $data->message,
            );
        }
        wp_send_json_success($response);
        wp_die();
	}

	public function dd_success() {
		ob_start();
		global $message;
		if(isset($_POST['message']) && $_POST['message'] != "" ) {
            $message = $_POST['message'];
        }
		include DM_ABSPATH . '/template/auth/dd_success.php';
		$response = array(
            'type' 	=> 'success',
            'html'	=> ob_get_clean(),
		);
		wp_send_json_success($response);
		wp_die();
	}

	public function changed_password() {
		$data = DM_Curl::HTTPPost($_POST,'change-password');
		$user = json_decode($data);

		$txt =  $data;
 		$myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

		if($user->status == 'success'){
			if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
				global $datum_user;
				$data = DM_Curl::HTTPGet('user');
				$datum_user = json_decode($data);
				include DM_ABSPATH . '/template/auth/updateprofile.php';
			}

			$response = array(
	            'type' 	=> 'success',
				'html'	=> ob_get_clean(),
			);

		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> $user->errors
			);
		}
		wp_send_json_success($response);
		wp_die();
	}

	public function request_info() {
        $data = DM_Curl::HTTPPost($_POST,'request-inquire');
        $request = json_decode($data);

        $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

        if($request->status == 'success'){
            $response = array(
                'type' 	=> 'success',
                'html'	=> $request->message,
            );
        }else{
            $response = array(
                'type' 	=> 'failure',
                'html'	=> $request->errors
            );
        }
        wp_send_json_success($response);
        wp_die();
    }
	public function datum_logout(){
		$data 	= DM_Curl::HTTPGet('logout',$_GET);
		$logout = json_decode($data);

		if($logout->status == 'success'){
			unset($_COOKIE['access_token']);
			setcookie('access_token', null, -1, '/');
			$response = array(
	            'type' 	=> 'success',
			);
		}else{
			$response = array(
	            'type' 	=> 'failure',
	            'html'	=> $errors
			);
		}

		wp_send_json_success($response);
		wp_die();
	}

	public function read_property_name() {
        $data = DM_Curl::HTTPPost($_POST,'read-property-name');
        $request = json_decode($data);

        if($request->status == 'success'){
            $html = '<ul id="property-name">';
            if(!empty($request->data)) {
                foreach ($request->data as $value) {
                    $html .= '<li>'.$value->name.'</li>';
                }
            }
            $html .= '</ul>';
            $response = array(
                'type' 	=> 'success',
                'html'	=> $html,
            );
        }else{
            $response = array(
                'type' 	=> 'failure',
                'html'	=> $request->errors
            );
        }
        wp_send_json_success($response);
        wp_die();
    }

    public function resend_email(){
    	$data = DM_Curl::HTTPPost($_POST,'resend-email-verification');
        $request = json_decode($data);

        if($request->status == 'success'){
            $response = array(
                'type' 	=> 'success',
                'html'	=> $request->message
            );
        }else{
        	$response = array(
                'type' 	=> 'failure',
                'html'	=> $request->errors
            );
        }
        wp_send_json_success($response);
        wp_die();
    }
    public function update_email(){
    	global $datum_user;
    	$data = DM_Curl::HTTPPost($_POST,'change-email');
        $request = json_decode($data);

        if($request->status == 'success'){
        	$response = array(
                'type' 	=> 'success',
                'html'	=> $request->message,
                'email'	=> $_POST['email']
            );
        }else{
        	$response = array(
                'type' 	=> 'failure',
                'html'	=> $request->errors
            );
        }
        wp_send_json_success($response);
        wp_die();
    }

    public function send_otp(){
		global $datum_user;
        if(!empty($_POST['mobile_phone'])){
            $_POST['mobile_phone'] = str_replace('-', '', $_POST['mobile_phone']);
        }

        if(isset($_POST['otp']) && $_POST['otp'] != ''){
        	$_POST['otp'] = str_replace('-', '', $_POST['otp']);
        	$data = DM_Curl::HTTPPost($_POST,'verify-mobile-otp');
	        $request = json_decode($data);
	        if($request->status == 'success'){
/*	        	$datum_user = $request->user;
	        	$cookie_name 	= "access_token";
				$cookie_value 	= $request->user->access_token;
				setcookie($cookie_name, $cookie_value, time() + 86400, "/");*/
	        	$response = array(
	                'type' 	=> 'success',
	                'html'	=> $request->message,
	                'verify'=> 1
	            );
	        }else{
	        	if(empty($request->errors)){
	        		$response = array(
		                'type' 	=> 'failure',
		                'html'	=> $request->message,
		                'array'	=> '0',
		            );
	        	}else{
		        	$response = array(
		                'type' 	=> 'failure',
		                'html'	=> $request->errors,
		                'array'	=> '1',
		            );
	        	}
	        }
        }else{

	    	$data = DM_Curl::HTTPPost($_POST,'resend-mobile-otp');
	        $request = json_decode($data);
	       	if($request->status == 'success'){
	        	$response = array(
	                'type' 	=> 'success',
	                'html'	=> $request->message,
	                'verify'=> 2
	            );
	        }else{
	        	if(empty($request->errors)){
	        		$response = array(
		                'type' 	=> 'failure',
		                'html'	=> $request->message,
		                'array'	=> '0',
		            );
	        	}else{
		        	$response = array(
		                'type' 	=> 'failure',
		                'html'	=> $request->errors,
		                'array'	=> '1',
		            );
	        	}
	        }
        }

        wp_send_json_success($response);
        wp_die();
    }

    public function reset_password() {
        if(isset($_POST['reset_token']) && $_POST['reset_token'] != "") {
            $_POST['token'] = $_POST['reset_token'];
            unset($_POST['reset_token']);
        }
        $data = DM_Curl::HTTPPost($_POST,'reset');
        $request = json_decode($data);
        if($request->status == 'success') {
            $response = array(
                'type' 	=> 'success',
                'html'	=> $request->message,
            );
        }
        wp_send_json_success($response);
        wp_die();
    }


    public function errorcheck($request = array()){
    	if(empty($request->errors)){
    		$response = array(
                'type' 	=> 'failure',
                'html'	=> $request->message,
                'array'	=> '0',
            );
    	}else{
        	$response = array(
                'type' 	=> 'failure',
                'html'	=> $request->errors,
                'array'	=> '1',
            );
    	}
    	return $response;
    }
    
    public function press_release($request = array()){
    	$data 		= DM_Curl::HTTPPost($_POST,'add-pressrelease');
	    $request 	= json_decode($data);
	    if($request->status == 'success') {
	    	if($request->data->IsPressReleaseFile == 1){
				$response = array(
					'type' 	=> 'success',
					'press_release_type'	=> 1,
					'is_press_release'	=> 1,
					'pp_link'	=> home_url('') .'/wp-content/uploads/press_release/'.$request->data->PropertyID.'/'.$request->data->PressReleaseFile,
					'pp_name'	=> $request->data->PressReleaseFile,
				);
			}else{
				$response = array(
					'type' 	=> 'success',
					'press_release_type'	=> 1,
					'is_press_release'	=> 0,
					'pp_link'	=> $request->data->PressReleaseLink,
				);
			}
        }else{
	    	$response 	= errorcheck($user);
        }
	    wp_send_json_success($response);
		wp_die();
    }

    public function contact_form(){
		$data 		= DM_Curl::HTTPPost($_POST,'contact-property');
	    $request 	= json_decode($data);
	    if($request->status == 'success') {
	    	$response = array(
				'type' 	=> 'success',
				'html' 	=> 'Message sent successfully',
			);
	    }else{
	    	$response 	= errorcheck($request);
	    }
	    wp_send_json_success($response);
		wp_die();
    }

    public function share_property(){
    	$data 		= DM_Curl::HTTPPost($_POST,'share-property');

	    $request 	= json_decode($data);

		if($request->status == 'success') {
	    	$response = array(
				'type' 	=> 'success',
				'html' 	=> 'Message sent successfully',
			);
	    }else{
	    	$response 	= errorcheck($request);
	    }
	    wp_send_json_success($response);
		wp_die();	    
    }

    public function showing_user_detalis(){
    	global $datum_user;
		$data = DM_Curl::HTTPGet('user',array());
		$datum_user = json_decode($data);

		ob_start();
			include DM_ABSPATH . '/template/auth/user_dropdown.php';

        $response = array(
			'type' 	=> 'success',
			'html' 	=> ob_get_clean()
		);
		wp_send_json_success($response);
		wp_die();
    }
}
DM_AJAX::init();
<?php
defined( 'ABSPATH' ) || exit;
/**
 * DM_Query Class.
 */
class DM_Curl {


    public function httpHader(){
        return array('activation_key:'.get_option('datum_api_key_id'),'site_url:'. home_url());
    }

	/**
	 * Get any errors from querystring.
	 */
	public function get_errors() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$error = ! empty( $_GET['dm_error'] ) ? sanitize_text_field( wp_unslash( $_GET['dm_error'] ) ) : '';

		if ( $error && ! dm_has_notice( $error, 'error' ) ) {
			dm_add_notice( $error, 'error' );
		}
	}
    /**
     * @description Make HTTP-GET call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    
    public static function HTTPGet($url ='',$params = [],$access_token = '') {
        $query = http_build_query($params);
        $httpHader = array('activation_key:'.get_option('datum_api_key_id'),'site_url:'. home_url());
        
        if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
            array_push($httpHader,'Authorization:Bearer '. $_COOKIE['access_token']);
        }else if($access_token != '') {
            array_push($httpHader,'Authorization:Bearer '. $access_token);
        }
        $ch = curl_init(Datum_API_URL.$url.'?'.$query);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$httpHader);
        $response = curl_exec($ch);
        
        curl_close($ch);
        return $response; 
    }
    
    /**
     * @description Make HTTP-POST call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPPost($params = array(), $url = '', $http = true, $access_token = '',$file = array()) {
         
        $httpHader = array('activation_key:'.get_option('datum_api_key_id'),'site_url:'. home_url(),'Accept:application/json');

        if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '' && $access_token == '') {
            array_push($httpHader,'Authorization:Bearer '. $_COOKIE['access_token']);
        }else if($access_token != '') {
            array_push($httpHader,'Authorization:Bearer '. $access_token);
        }

        //$_FILES['avatar'] = array();
        if(isset($_FILES['avatar']) && $_FILES['avatar']['name'] != ''){
            if (function_exists('curl_file_create')) {
                $cFile = new CurlFile($_FILES['avatar']['tmp_name'], $_FILES['avatar']['type'], $_FILES['avatar']['name']);
                //$cFile = curl_file_create($data['ad_paths']);
            } else {
                $cFile = '@' . realpath($_FILES['file']['tmp_name']);
            }
            $params['avatar'] = $cFile;
            $query = $params;
        }else{
            $query = http_build_query($params);
            //$query = $params;
        }

        $ch    = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($http){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHader);
        }
        
        curl_setopt($ch, CURLOPT_URL, Datum_API_URL . $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_ENCODING, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);

        curl_close($ch);
        
        return $response;
    }
    /**
     * @description Make HTTP-PUT call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPPut(array $params) {
        $query = \http_build_query($params);
        $ch    = \curl_init();
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HEADER, false);
        \curl_setopt($ch, \CURLOPT_URL, Datum_API_URL);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'PUT');
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $query);
        $response = \curl_exec($ch);
        \curl_close($ch);
        return $response;
    }
    /**
     * @category Make HTTP-DELETE call
     * @param    $url
     * @param    array $params
     * @return   HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPDelete(array $params) {
        $query = \http_build_query($params);
        $ch    = \curl_init();
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HEADER, false);
        \curl_setopt($ch, \CURLOPT_URL, Datum_API_URL);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'DELETE');
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $query);
        $response = \curl_exec($ch);
        \curl_close($ch);
        return $response;
    }
}
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



/**
 * Template pages
 */

if ( ! function_exists( 'datum_add_post_setting' ) ) {

	function datum_add_post_setting( $args = array() ) {
		if(isset($_POST['datum_settings'])){
			
		}
	}
}

if ( ! function_exists( 'dm_get_page_id' ) ) {

	function dm_get_page_id( $name = '' ,$post_type = "page") {
		
		
	   	return get_option($name);
	}
}

if ( ! function_exists( 'dm_get_page_link' ) ) {
	function dm_get_page_link( $name = '' ,$post_type = "page") {
		$name = get_post(get_option($name));
	   	return home_url() .'/'. $name->post_name;
	}
}
if ( ! function_exists( 'datum_property_loop_start' ) ) {

	/**
	 * Output the start of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_loop_start( $echo = true ) {

		include_once DM_ABSPATH . 'template/loop/loop-start.php';
	}
}

if ( ! function_exists( 'datum_property_loop_end' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_loop_end( $echo = true ) {

		include_once DM_ABSPATH . 'template/loop/loop-end.php';
	}
}

if ( ! function_exists( 'datum_property_call' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_call( $echo = true ) {

		return true;
	}
}
if ( ! function_exists( 'datum_property_title' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_title( $echo = true ) {

		include DM_ABSPATH . 'template/loop/loop-title.php';
	}
}
if ( ! function_exists( 'datum_property_price' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_price( $echo = true ) {

		include DM_ABSPATH . 'template/loop/loop-price.php';
	}
}
if ( ! function_exists( 'datum_property_style' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_style( $echo = true ) {

		include DM_ABSPATH . 'template/loop/loop-style.php';
	}
}
if ( ! function_exists( 'datum_property_due_date' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_due_date( $echo = true ) {

		include DM_ABSPATH . 'template/loop/loop-due-date.php';
	}
}
if ( ! function_exists( 'datum_property_image' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_image( $echo = true ) {

		include DM_ABSPATH . 'template/loop/loop-image.php';
	}
}
if ( ! function_exists( 'datum_property_link' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_link( $echo = true ) {
		global $property_post;
		//$post_name  = get_option('datum_property_listing_id');
		//$dm_post 	= get_post($post_name);
		ob_start();
			//echo '<a href="'.home_url($dm_post->post_name).'/'.$property_post->id.'">';
			echo '<div class="datum_property_listing">';
			do_action('datum_loop_image');    	
            do_action('datum_loop_style');
            echo '</div>';
            //echo '</a>';
		echo ob_get_clean();
	}
}
if ( ! function_exists( 'datum_setting_tab' ) ) {

	function datum_setting_tab(){
		
	}
}
if ( ! function_exists( 'datum_setting_tab_name' ) ) {

	function datum_setting_tab_name(){
		return array(
			'general' 		=> 'General',
			'integration' 	=> 'Integration',
			'advanced'		=> 'Advanced',
		);
	}
}

if ( ! function_exists( 'datum_property_lits' ) ) {

	/**
	 * Output the end of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function datum_property_lits( $echo = true ) {
		global $property;
		$url = Datum_API_URL . "property";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_POST, true);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$contents = curl_exec($ch);
		curl_close($ch);
		$property = json_decode($contents);
		if(!empty($contents)){
			return true;
		}else{
			return false;
		}
	}
}
if( ! function_exists('datum_single_content') ) {

	function datum_single_content(){
		global $single_property;
		include DM_ABSPATH . 'template/single/main_image.php';
	}
}

if( ! function_exists('datum_single_details_mainbox') ) {

	function datum_single_details_mainbox(){
		global $single_property;
		include DM_ABSPATH . 'template/single/details_mainbox.php';
	}
}

if( ! function_exists('datum_single_offering') ) {

	function datum_single_offering(){
		global $single_property, $datum_user, $checkCaSign;
		$postData = array('property_id' => getDMPropertyId() );
		$checkCaSign = DM_Curl::HTTPPost($postData,'check-ca-sign');
		$checkCaSign = json_decode($checkCaSign);
		$checkCaSign = $checkCaSign->data;
		include DM_ABSPATH . 'template/single/offering_summary.php';
	}
}

if( ! function_exists( 'datum_single_gallery_slider' ) ) {
    function datum_single_gallery_slider () {
        global $single_property;
        include DM_ABSPATH . 'template/single/single_gallery_slider.php';
    }
}
if( ! function_exists('datum_deal_team') ) {

	function datum_deal_team(){
		global $single_property;
		include DM_ABSPATH . 'template/single/deal_team.php';
	}
}

if( ! function_exists('datum_banner_section') ) {

	function datum_banner_section(){
		global $single_property;
		echo '<section class="datum_banner_section datum_innerpage_banner">
		    <div class="datum_banner_image">
		        <picture> <img src="http://dev.newmarkpcg.com/wp-content/themes/NGKF/images/re-ml.jpg" alt="Ontario Airport Tower Ontario CA Office building for sale" class="img-responsive"> </picture>
		        <div class="datum_gradient_below_text">
		            <div class="datum_banner_text">
		                <h1>'.get_the_title().'</h1>
		                <a href="#section1" class="scroll"><img src="../images/icons/down-arrow-white.svg" alt="" loading="lazy"></a>
		            </div>
		        </div>
		    </div>
		</section>';
	}
}

if( ! function_exists('datum_property_type_data') ) {

	function datum_property_type_data(){
		$data = DM_Curl::HTTPGet('property_commons');
		$filter = json_decode($data);
		$data_new 		= DM_Curl::HTTPGet('acquisitioncriteria');
		$criteria 	= json_decode($data_new);
		include DM_ABSPATH . 'template/property_filter.php';
	}
}

if( ! function_exists('datum_property_details_data') ) {

	function datum_property_details_data(){
		global $single_property;
		include DM_ABSPATH . 'template/single/property_details.php';
	}
}

if( ! function_exists('datum_property_single_image') ) {

	function datum_property_single_image(){
		global $single_property;
		return  home_url().'/wp-content/uploads/properties/'.$single_property->id.'/'.$single_property->banner_image;
	}
}

if( ! function_exists('datum_property_link') ) {

	function datum_property_link(){
		global $single_property;
		$post_name = get_option('datum_property_listing_id');
		$dm_post 	= get_post($post_name);

		return  home_url().'/'.$dm_post->post_name.'/'.$single_property->name.'/'.$single_property->id;
	}
}

if( ! function_exists('datum_property_single_title') ) {

	function datum_property_single_title(){
		global $single_property;
		return  $single_property->name;
	}
}
if( ! function_exists('datum_property_single_asking_price') ) {

	function datum_property_single_asking_price(){
		global $single_property;
		return  $single_property->asking_price;
	}
}
if( ! function_exists('datum_property_single_property_status') ) {

	function datum_property_single_property_status(){
		global $single_property;
		return  $single_property->property_status;
	}
}

function get_user_value($name = '',$value = '',$type = ''){
	global $datum_user;
	if(!empty($datum_user) && $name['get_name'] != ''){
			return $name['get_name']($value);
		//if($type == 'text'){
		/*}else if ($type == 'select') {
			if($value == $datum_user->$name){
				return 'selected';
			}
		}else if ($type == 'checkbox') {
			$impl = explode(',',$datum_user->$name);
			if(in_array($value,$impl)){
				return 'checked';
			}

		}else if ($type == 'radio') {
			if($value == $datum_user->$name){
				return 'checked';
			}
		}else if($type == 'password'){
			return '*******';
		}else if($type == 'file'){
			if($datum_user->$name != ''){
				return '<img src="'.$datum_user->$name.'" class="img-fluid" data-id="1" id="datum_file_show">';
			}*/
		//}
	}else{
		switch ($type) {
			case 'file':
					return '<img src="'.DATUM_PLUGIN_URL.'/images/icons/image-placeholder.png" class="img-fluid" id="datum_file_show">';
				break;
			case 'select':
			echo $value;
				return $name['get_name']($value);
				break;
			default:
				# code...
				break;
		}
	}
}

if( ! function_exists('datum_property_mainbox') ) {

	function datum_property_mainbox(){
		global $single_property;
		return
		array(
			array(
				'image'	=> '',
				'label'	=> '',
				'value'	=> ''
			),
			array(
				'image'	=> '',
				'label'	=> '',
				'value'	=> ''
			),
			array(
				'image'	=> '',
				'label'	=> '',
				'value'	=> ''
			),
			array(
				'image'	=> '',
				'label'	=> '',
				'value'	=> ''
			),
			array(
				'image'	=> '',
				'label'	=> '',
				'value'	=> ''
			),
		);
	}
}


if( ! function_exists('login_sign_up') ) {

	function login_sign_up($step){
		$login = new Signup();
		echo $login->login_pages_step($step);
	}
}

if( ! function_exists('login_update_up') ) {

	function login_update_up($step){
		$login = new Signup();
		echo $login->login_pages_update_step($step);
	}
}

if( ! function_exists('get_parameter_data') ) {

	function get_parameter_data($name,$value){
		$post_type_id = get_query_var('args');

		if($post_type_id != ''){
			if($post_type_id == $value){
				echo 'selected';
			}
		}

		if(isset($_GET) && $_GET[$name] != ''){
			if($_GET[$name] == $value){
				echo 'selected';
			}
		}
	}
}
if( ! function_exists('get_parameter_search') ) {

	function get_parameter_search(){
		
		if(isset($_GET) && $_GET['search'] != ''){
			//if($_GET['search'] == $){
			echo $_GET['search'];
			//}
		}
	}
}
if( ! function_exists('get_parameter_map') ) {

	function get_parameter_map(){
		
		if(isset($_GET) && $_GET['map'] == '1'){
			echo 'checked';
		}else{

		}
	}
}

if( ! function_exists('datum_social_share_action') ) {

	function datum_social_share_action(){
		
		
	}
}

/**
 * Confidential agrement preview and attach run time page
 */
if( ! function_exists('previw_ca') ) {
	function previw_ca(){
		global $wpdb, $datum_user, $single_property;
		
		if ( is_null($single_property->uploaded_ca_filename) || empty($single_property->uploaded_ca_filename) || $datum_user->id == 0) {

			echo '
			<link rel="stylesheet" type="text/css" href="'.site_url().'/wp-content/plugins/datum/assets/css/custom/error_ca.css" lazyload="1">
			<section class="error-section pt-50" style="padding-top: unset;padding-bottom: unset;">
				<picture>
					<img src="'.home_url().'/wp-content/plugins/datum/images/404-Images/404-error.jpg" alt="Sketch of a man frustrated with his computer" class="img-responsive" loading="lazy" width="380px">
				</picture>
				<div class="error-text">
					<p style="width:100%;">Confidentiality Agreement is not available.</p>
				</div>
			</section>';
			exit;
		}
		
		/*global $wpdb, $datum_user, $single_property;
		$content = home_url().'/wp-content/plugins/datum/pdf/child-website-04Mar21.pdf';
		echo $content;*/
		//include DM_ABSPATH . 'agreement/previw_ca.php';

		$upload_dir = wp_upload_dir();
		
		require_once (DM_ABSPATH.'MPDF_Lib/mpdf.php');

		$HeaderHTML = '';

		$printable = '';
		$footerHTML	= '';
		$head = '';
		
		$HeaderHTML = '
		<table style="width: 100%; font-family: Arial;border:none;" cellspacing="2" cellpadding="2">
			<tr>
				<td><img src="'.home_url().'/wp-content/plugins/datum/images/logo_black.png" width="120"></td>
			</tr>
		</table>
		<hr style="height: 1px;margin: 0px; padding: 0px;color: #000;" />';

		$property_Address = $single_property->address1;
		if (!empty($single_property->address2) || !is_null($single_property->address2)) {
			$property_Address .= ', '.$single_property->address2;
		}
		$property_Address .= ', '.$single_property->city;
		$property_Address .= ', '.$single_property->state.' '.$single_property->zipcode;

		$username = ucwords(strtolower($datum_user->first_name.' '.$datum_user->last_name));

		$workphone = '';
		if (!empty($datum_user->cell_phone) || !is_null($datum_user->cell_phone)) {
			$workphone = preg_replace('/\d{3}/', '$0-', str_replace('. ', null, trim($datum_user->cell_phone)), 2);
		}

		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$user_ip = $_SERVER['REMOTE_ADDR'];
		}

		$statename = $datum_user->name;

		$current_date = date('m/d/Y');
		$current_time = date('h:i A').' PST';

		$printable = '
			<div>
				<p align="center" style="text-align:center;margin-bottom:30px;font-size:18px;"><strong>ELECTRONIC ACCEPTANCE ADDENDUM</strong></p>
				<table class="OEPL_table" style="width: 100%;">
					<tr>
						<td colspan="2"><strong>LISTING NAME: </strong>'.ucwords(strtolower($res->name)).'</td>
					</tr>
					<tr>
						<td colspan="2"><strong>LISTING ADDRESS: </strong>'.$property_Address.'</td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td><strong>Name: </strong>'.$username.'</td>
						<td><strong>Company: </strong>'.$res_user->company.'</td>
					</tr>
					<tr>
						<td><strong>Address: </strong>'.$res_user->street.' '.$res_user->suite.'</td>
						<td><strong>City: </strong>'.$res_user->city.'</td>
					</tr>
					<tr>
						<td><strong>State: </strong>'.$statename.'</td>
						<td><strong>Zip Code: </strong>'.$res_user->zipcode.'</td>
					</tr>
					<tr>
						<td><strong>Work Phone: </strong>'.$workphone.'</td>
						<td><strong>Email Address: </strong>'.$res_user->email.'</td>
					</tr>
					<tr>
						<td style="vertical-align:middle;padding-bottom: 8px !important;"><strong>Signature: </strong><span style="font-size:28px;font-family:vladimir;">'.$username.'</span></td>
						<td><strong>IP Address: </strong>'.$user_ip.'</td>
					</tr>
					<tr>
						<td><strong>Date: </strong>'.$current_date.'</td>
						<td><strong>Time: </strong>'.$current_time.'</td>
					</tr>
				</table>
			</div';
		
		## stylesheet
		$stylesheet = '
		table{ width: 100%; border: 0.5px solid #ddd; font-size:12px;}
		tr th {background: #eee;text-align:left !important;}
		tr td, tr th { padding: 5px;height: 30px;}
		p {text-indent: 50px;text-align:justify;}
		.OEPL_table {border:none !important;font-size:14px;width:100%;}
		.OEPL_table tr td {padding:0 !important;}';
		
		#============== START Footer HTML
		$footerHTML .= '<hr style="height: 1px; color: #000; margin: 0px; padding: 0px;" />';
		$footerHTML .= '<div style="text-align:center;">{PAGENO}</div>';
		#============== END Footer HTML
		
		$margin_left = 10;
		$margin_right = 10;
		$margin_top = 20;
		$margin_bottom = 20;
		$margin_header = 5;
		$margin_footer = 10;
		
		$pdf = new mPDF('en', 'A4', '', 'proximanovaalt', $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer);
		$pdf->fontdata['proximanovaalt'] = array('R' => "ProximaNovaAlt.ttf", 'B' => "ProximaNovaAlt-Bold.ttf", );
		
		$pdf->SetImportUse();
		$pagecount = $pdf->SetSourceFile($upload_dir['basedir'].'/property_ca_document/'.$single_property->id.'/'.$single_property->uploaded_ca_filename);

		if(!$pagecount){
			echo '
			<link rel="stylesheet" type="text/css" href="'.site_url().'/wp-content/plugins/datum/assets/css/custom/error_ca.css" lazyload="1">
			<section class="error-section pt-50" style="padding-top: unset;padding-bottom: unset;">
				<picture>
					<img src="'.home_url().'/wp-content/plugins/datum/images/404-Images/404-error.jpg" alt="Sketch of a man frustrated with his computer" class="img-responsive" loading="lazy" width="380px">
				</picture>
				<div class="error-text">
					<p style="width:100%;">Confidentiality Agreement is not available.</p>
				</div>
			</section>';
			exit;
		}

		for ($i = 1; $i <= $pagecount; $i++) {
			$tplId = $pdf->ImportPage($i);
			$pdf->UseTemplate($tplId);
			if ($i != $pagecount) {
				$pdf->WriteHTML('<pagebreak />');
			}
		}

		## new page add
		$pdf->SetHTMLHeader($HeaderHTML);
		$pdf->AddPage();
		$pdf->SetHTMLFooter($footerHTML);

		$pdf->WriteHTML($stylesheet, 1);
		$pdf->WriteHTML($printable);
		
		//$content = $pdf->Output($file_path, 'S');
		$filename = str_replace(' ', '', $single_property->name);
		$pdf->Output($upload_dir['basedir'].'/property_ca_document/'.$single_property->id.'/'.$filename.'.pdf','F');
		$content = home_url().'/wp-content/uploads/property_ca_document/'.$single_property->id.'/'.$filename.'.pdf';
		echo $content;
	}
}

function pr($data){
	echo '<pre>';
	print_r($data);
	echo "</pre>";
}
function errorcheck($request){
//    	pr($request);
//    	die;
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
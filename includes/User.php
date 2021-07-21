<?php 
class User 
{
	const DEFAULT_VALIDATION_MSG 	= "Please fill the required field.";

	public function loginProcess($value='')
	{
		$error = $this->validate($_POST);
		if($error){
	 		$response = array(
	            'type' => 'failure',
	            'html' => $error
			);
	 	}else{

	 		global $post,$wpdb;
			$user_id = email_exists($value['email']);
			$user  		= get_userdatabylogin($value['email']);
			$user_id 	= email_exists($value['email']);

			if((!empty($user)) || (!empty($user_id)) ){
				
				$logincheck = wp_login($value['email'],$value['password']);
				if($logincheck == 1){
					wp_clear_auth_cookie();
			        $info                   = array();
			        $info['user_login']     = $value['email'];
			        $info['user_password'] 	= $value['password'];
			        $info['remember']       = true;
			        $user_signon            = wp_signon( $info, true );
					global $current_user;
		            wp_set_current_user($user_signon->ID);
		            do_action('set_current_user');
		            $current_user = wp_get_current_user();
					$response = array(
			            'type' 	=> 'success',
			            'url'	=> (isset($value['url'])) ? (!empty($value['url'])) ? $value['url'] :site_url('my-account/dashboard') : site_url('my-account/dashboard'),
					);
					
				}else{
					$response = array(
			            'type' => 'failure',
			            'html' => array('password'=>'Invalid credentials.'),
					);
				}
			}else{
				$response = array(
		            'type' => 'failure',
		            'html' => array('email'=>'Entered email does not exist.'),
				);
			}	
	 	}
	 	return $response;
	}
	public function validate($data = null)
	{
		$error =array();
		foreach ($data as $key => $value) {
			switch ($key) {
				case 'password':
				case 'new_password':
				case 're_password':
					if(empty($value)){
						$error[$key] = self::DEFAULT_VALIDATION_MSG;
					}
					break;
				case 'email':
					if(empty($value)){
						$error[$key] = self::DEFAULT_VALIDATION_MSG;
					}elseif (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
					    $error[$key] = $value ." is not a valid email address.";
					} 
					break;
			case 'f_email':
					if(empty($value)){
						$error[$key] = self::DEFAULT_VALIDATION_MSG;
					}elseif (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
					    $error[$key] = $value ." is not a valid email address.";
					} 
					break;
				default:
					break;
			}
		}
		if(isset($data['new_password']) && isset($data['re_password'])){
			 if(!empty($data['new_password']) && !empty($data['re_password'])){
                if($data['new_password'] != $data['re_password'])
                {
					$error['re_password'] = "The password combination does not match.";
				}
			}
		}

		return $error;
	}
	public function forgotContinueProcess($data = null){
		$error = $this->validate($data);
		if($error){
	 		$response = array(
	            'type' => 'failure',
	            'html' => $error
			);
		
		}else{
			$user_id = email_exists($data['f_email']);
			if($user_id){
				$url = 'f_email='.$data['f_email'].'&user_id='.$user_id;
				update_user_meta($user_id,'user_forgot_token',base64_encode($url));
				$mail = new Email();
				//user email
				$user_to 		= $data['f_email'] ;
				$user_subject 	= "CarPartner: Forgot Password";
				ob_start();
				require_once( dirname( MEMBERSHIP ) . '/email/forgotpassword.php' );
				$user_message 	= ob_get_clean();
				$mail->membershipMail($user_to,$user_subject,$user_message);
				$response = array(
		            'type' => 'success',
		            'html' => array('A reset password link has been sent to your registered email.'),
				);
			}else{
				$response = array(
		            'type' => 'failure',
		            'html' => array('f_email'=>'Entered email does not exist.'),
				);
			}	
		}
		return $response;
	}
	public function passwordChangeProcess($data = null){
		$error = $this->validate($data);
		if($error){
	 		$response = array(
	            'type' => 'failure',
	            'html' => $error
			);
		}else{
			wp_set_password($data['new_password'], $data['user_id']);
			delete_user_meta($data['user_id'],'user_forgot_token');
			$response = array(
	            'type' => 'success',
	            'html' => array('Your password has been changed'),
			);
		}
		return $response;
	}
}

?>
<?php
defined( 'ABSPATH' ) || exit;
/**
 * Email send Class.
 */
class EmailSend {
    public $MAIL_DETAILS = "1.0.0";
    public function __construct()
    {
        $this->MAIL_DETAILS = self::getSendGridApiKey();
    }

    public function sendemail( $subject, $tos, $message, $ccs = array(), $attachment = '', $replyto = '' ){

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->MAIL_DETAILS->SENDGRID_EMAIL, $this->MAIL_DETAILS->SENDGRID_NAME);
        $email->setSubject($subject);
        
        foreach (array_unique($tos, SORT_REGULAR) as $to) {
            $email->addTo($to['email'], $to['name']);
        }

        if (!empty($ccs)) {
            foreach ($ccs as $cc) {
                $email->addCc($cc['email'], $cc['name']);
            }	
        }
        
        if (!empty($attachment)) {
            $file_encoded = base64_encode(file_get_contents($attachment['path']));
            $email->addAttachment(
                $file_encoded,
                "application/text",
                $attachment['filename'],
                "attachment"
            );
        }

        if (!empty($replyto)) {
            $email->setReplyTo($replyto);
        }

        $email->addContent("text/html", $message);
        $apiKey = $this->MAIL_DETAILS->SENDGRID_API_KEY;
        
        $sg = new \SendGrid($apiKey);
        
        $response = $sg->client->mail()->send()->post($email);
        return $response->statusCode();
    }

    function email_content( $name='', $content, $skip_footer = false){
        $oepl_message = '';
        $oepl_message .= '<body style="font-family: sans-serif;">';
        $oepl_message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 20px;">';
        $oepl_message .= '<tr>';
        $oepl_message .= '<td align="left" bgcolor="#ffffff" style="padding: 10px; font-family: Arial, Helvetica, sans-serif; border-top: 3px solid #000F9F;">';
        if (!empty($name)) {
            $oepl_message .= '<p>Dear '.$name.',</p>';
        }
        $oepl_message .= $content;
        
        if (!$skip_footer) {
            $oepl_message .= '<div style="margin-bottom: 0px;float: left;">';
                $oepl_message .= $this->MAIL_DETAILS->EMAIL_SIGNATURE;
            $oepl_message .= '</div>';
        }
        $oepl_message .= '</tr>';
        $oepl_message .= '</table>';
        $oepl_message .= '</body>';
        return $oepl_message;
    }
    
    public function getSendGridApiKey() {
        $data = DM_Curl::HTTPGet('get-configuration');
        $data = json_decode($data);
        if( $data->status == 'success') {
            return $data->data;
        }
    }
}
?>
<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
require_once(dirname(__FILE__).'/includes/class-dm-curl.php');
require_once (DM_ABSPATH.'lovepdf/vendor/autoload.php');
use Ilovepdf\Ilovepdf;
global $wpdb;		
error_reporting(0);

global $wpdb, $single_property, $datum_user;
if(isset( $_GET['p_id'] ) && $_GET['p_id'] !='') {
    $property_id = $_GET['p_id'];
    $id = "property/".$property_id;
    $data = DM_Curl::HTTPGet($id);
    $property = json_decode($data);
    $single_property = $property->data;	
    $data = DM_Curl::HTTPGet('user');
    $datum_user = json_decode($data);

    if ( is_null(getDMPropertyUploadedCaFilename()) || empty(getDMPropertyUploadedCaFilename()) || getDMUserId() == 0) {

        echo '
        <link rel="stylesheet" type="text/css" href="'.DATUM_PLUGIN_URL.'assets/css/custom/error_ca.css" lazyload="1">
        <section class="error-section pt-50" style="padding-top: unset;padding-bottom: unset;">
            <picture>
                <img src="'.DATUM_PLUGIN_URL.'images/404-Images/404-error.jpg" alt="Sketch of a man frustrated with his computer" class="img-responsive" loading="lazy" width="380px">
            </picture>
            <div class="error-text">
                <p style="width:100%;">Confidentiality Agreement is not available.</p>
            </div>
        </section>';
        exit;
    }

    $upload_dir = wp_upload_dir();
    
    require_once (DM_ABSPATH.'MPDF_Lib/mpdf.php');
    
    $HeaderHTML = '';

    $printable = '';
    $footerHTML	= '';
    $head = '';
    
    $HeaderHTML = '
    <table style="width: 100%; font-family: Arial;border:none;" cellspacing="2" cellpadding="2">
        <tr>
            <td><img src="'.DATUM_PLUGIN_URL.'images/logo_black.png" width="120"></td>
        </tr>
    </table>
    <hr style="height: 1px;margin: 0px; padding: 0px;color: #000;" />';

    $property_Address = getDMPropertyAddress1();
    if (!empty(getDMPropertyAddress2()) || !is_null(getDMPropertyAddress2())) {
        $property_Address .= ', '.getDMPropertyAddress2();
    }
    $property_Address .= ', '.getDMPropertyCity();
    $property_Address .= ', '.getDMPropertyState().' '.getDMPropertyZipcode();

    $username = ucwords(strtolower(getDMUserFirstName().' '.getDMUserFirstName()));

    $workphone = '';
    if (!empty(getDMUserWorkPhone()) || !is_null(getDMUserWorkPhone())) {
        $workphone = preg_replace('/\d{3}/', '$0-', str_replace('. ', null, trim(getDMUserWorkPhone())), 2);
    }

    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $user_ip = $_SERVER['REMOTE_ADDR'];
    }

    $statename = getDMUserState();

    $current_date = date('m/d/Y');
    $current_time = date('h:i A').' PST';

    $printable = '
        <div>
            <p align="center" style="text-align:center;margin-bottom:30px;font-size:18px;"><strong>ELECTRONIC ACCEPTANCE ADDENDUM</strong></p>
            <table class="OEPL_table" style="width: 100%;">
                <tr>
                    <td colspan="2"><strong>LISTING NAME: </strong>'.ucwords(strtolower(getDMPropertyName())).'</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>LISTING ADDRESS: </strong>'.$property_Address.'</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td><strong>Name: </strong>'.$username.'</td>
                    <td><strong>Company: </strong>'.getDMUserCompanyName().'</td>
                </tr>
                <tr>
                    <td><strong>Address: </strong>'.getDMUserStreet().' '.getDMUserSuite().'</td>
                    <td><strong>City: </strong>'.getDMUserCity().'</td>
                </tr>
                <tr>
                    <td><strong>State: </strong>'.$statename.'</td>
                    <td><strong>Zip Code: </strong>'.getDMUserZipCode().'</td>
                </tr>
                <tr>
                    <td><strong>Work Phone: </strong>'.$workphone.'</td>
                    <td><strong>Email Address: </strong>'.getDMUserEmail().'</td>
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
    $upload_dir   = wp_upload_dir();
    
    $pdf->SetImportUse();
    $pagecount = $pdf->SetSourceFile($upload_dir['basedir'].'/property_ca_document/'.getDMPropertyId().'/'.getDMPropertyUploadedCaFilename());

    if(!$pagecount) {
        $ilovepdf = new Ilovepdf(DATUM_ILOVEPDF_KEY,DATUM_ILOVEPDF_SECRET_KEY);
        $myTask = $ilovepdf->newTask('repair');
        $file1 = $myTask->addFile($upload_dir['basedir'].'/property_ca_document/'.getDMPropertyId().'/'.getDMPropertyUploadedCaFilename());
        $myTask->execute();
        $wprootpath = DM_ABSPATH;
        $myTask->download($wprootpath.'/Ilovepdf_files/');
        if(file_exists( $wprootpath.'/Ilovepdf_files/'.getDMPropertyUploadedCaFilename() )) {
            unlink($upload_dir['basedir'].'/property_ca_document/'.getDMPropertyId().'/'.getDMPropertyUploadedCaFilename());
            copy ($wprootpath.'/Ilovepdf_files/'.getDMPropertyUploadedCaFilename(), $upload_dir['basedir'].'/property_ca_document/'.getDMPropertyId().'/'.getDMPropertyUploadedCaFilename());
            unlink($wprootpath.'/Ilovepdf_files/'.getDMPropertyUploadedCaFilename());
        }
    }

    $pdf = new mPDF('en', 'A4', '', 'proximanovaalt', $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer);
    $pdf->fontdata['proximanovaalt'] = array('R' => "ProximaNovaAlt.ttf", 'B' => "ProximaNovaAlt-Bold.ttf", );

    $pdf->SetImportUse();
    $pagecount = $pdf->SetSourceFile($upload_dir['basedir'].'/property_ca_document/'.getDMPropertyId().'/'.getDMPropertyUploadedCaFilename());

    if(!$pagecount){
        echo '
        <link rel="stylesheet" type="text/css" href="'.DATUM_PLUGIN_URL.'assets/css/custom/error_ca.css" lazyload="1">
        <section class="error-section pt-50" style="padding-top: unset;padding-bottom: unset;">
            <picture>
                <img src="'.DATUM_PLUGIN_URL.'images/404-Images/404-error.jpg" alt="Sketch of a man frustrated with his computer" class="img-responsive" loading="lazy" width="380px">
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
    
    $filename = str_replace(' ', '', getDMPropertyName());
    $guid = md5(uniqid());
    $pdf->Output($upload_dir['basedir'].'/ca_sign_documents/'.$guid, 'F');
    
    $property_name = '';
    $clientname = getDMPropertyClientName();
    
    if(!empty(getDMPropertyName())) {
        $property_name = '_' . str_replace(' ', '_', getDMPropertyName());
    }

    if(!empty($single_property->clientname)) {
        $clientname = '_' . str_replace(' ', '_', time());//$single_property->clientname);
    }
    
    $getID = $guid;
	$upload_dir = wp_upload_dir();
	$file_relative_path = "/ca_sign_documents/".$getID;
	$file_path = $upload_dir['basedir'].$file_relative_path;

    $fileName = 'Executed CA_'. $property_name . $clientname .'.pdf';

    $postData = array(
        'property_id' => getDMPropertyId(),
        'nda_pdf' => $fileName,
        'doc_id' => $guid,
        'email_copy' => 'No'
    );

    if( isset( $_GET['copy_email'] ) && $_GET['copy_email'] != '' && $_GET['copy_email'] == true ) {
        $postData['email_copy'] ='Yes';
        $email = new EmailSend();
        $subject = getDMPropertyName()." Confidentiality Agreement";
        $content = "";
        $content .= "<p>Thank you for executing the confidentiality agreement for ".getDMPropertyName().". Please find the attached executed document.</p>";
        $content .= '<p>Thank you,<br></p>';
        $attachment = array(
            'path' => $upload_dir['basedir'].'/ca_sign_documents/'.$getID,
            'filename' => $fileName,
        );

        $oepl_to = array(
            array(
                'email' => getDMUserEmail(),
                'name' => ''
            ),
        );
        
        $username = ucwords(strtolower(getDMUserFirstName().' '.getDMUserLastName()));
        
        $message = $email->email_content($username, $content);
        
        $semailStatus = $email->sendemail($subject, $oepl_to, $message, $ccs, $attachment);
    }

    $data = DM_Curl::HTTPPost($postData,'confidential-agreement-sign');

    header('Content-type:application/pdf');
    header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
    header("X-Content-Type-Options: nosniff");
    header("Content-Disposition:attachment;filename=".$fileName."");
    header('Content-Length: '.filesize( $file_path ));
    readfile($file_path);    
    exit;
}
?>
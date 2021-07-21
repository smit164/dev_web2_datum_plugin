<?php
/**
 * datum setup
 *
 * @package datum
 * @since   3.2.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main datum Class.
 *
 * @class datum
 */
if(!class_exists('WP_List_Table')){
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/*require_once (DM_ABSPATH.'MPDF_Lib/mpdf.php');
require_once (DM_ABSPATH.'lovepdf/vendor/autoload.php');

use Ilovepdf\Ilovepdf;*/

if (!class_exists('OM')) {
		
	class OM {
		public function output($template_path){
			global $single_property;
			if(isset( $_GET['p_id'] ) && $_GET['p_id'] !='') {
			    die(DM_ABSPATH);
			    $property_id = $_GET['p_id'];
			    $id = "property/".$property_id;
			    $data = DM_Curl::HTTPGet($id);
			    $property = json_decode($data);
			    $single_property = $property->data;

			    $data = DM_Curl::HTTPGet('user');
			    $datum_user = json_decode($data);

			    if ( is_null(getDMPropertyUploadedCaFilename()) || empty(getDMPropertyUploadedCaFilename()) || $datum_user->Id == 0) {
			        echo '
			        <link rel="stylesheet" type="text/css" href="'.DATUM_PLUGIN_URL.'assets/css/custom/error_ca.css" lazyload="1">
			        <section class="error-section pt-50" style="padding-top: unset;padding-bottom: unset;margin: auto 0;text-align: center;">
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

			    $username = ucwords(strtolower($datum_user->FirstName.' '.$datum_user->LastName));

			    $workphone = '';
			    if (!empty($datum_user->WorkPhone) || !is_null($datum_user->WorkPhone)) {
			        $workphone = preg_replace('/\d{3}/', '$0-', str_replace('. ', null, trim($datum_user->WorkPhone)), 2);
			    }

			    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    } else {
			        $user_ip = $_SERVER['REMOTE_ADDR'];
			    }

			    $statename = $datum_user->State;

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
			                    <td><strong>Company: </strong>'.$datum_user->CorporateLicense.'</td>
			                </tr>
			                <tr>
			                    <td><strong>Address: </strong>'.$datum_user->Suite.' '.$datum_user->Suite.'</td>
			                    <td><strong>City: </strong>'.$datum_user->City.'</td>
			                </tr>
			                <tr>
			                    <td><strong>State: </strong>'.$statename.'</td>
			                    <td><strong>Zip Code: </strong>'.$datum_user->ZipCode.'</td>
			                </tr>
			                <tr>
			                    <td><strong>Work Phone: </strong>'.$workphone.'</td>
			                    <td><strong>Email Address: </strong>'.$datum_user->Email.'</td>
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
			    $pdf->SetProtection(array('copy','print'), '');
			    $content = $pdf->Output($file_path, 'S');
				
				$FileNameMimeType = 'application/pdf';
				
				header('Content-Type:'.$FileNameMimeType );
				header('Content-Length: '. strlen( $content ));
				header('Content-disposition: inline; filename="PDF Preview"');
				header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
				header('Cache-Control: no-store, no-cache, must-revalidate');
				header('Cache-Control: post-check=0, pre-check=0', FALSE);
				header('Pragma: no-cache');
				echo $content;
				exit;
			}
		}
	}
}
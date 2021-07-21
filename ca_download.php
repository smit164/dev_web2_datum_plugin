<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
require_once(dirname(__FILE__).'/includes/class-dm-curl.php');
global $wpdb;
error_reporting(0);
if (isset($_GET['docID']) && $_GET['docID']) {
    $getID = $_GET['docID'];
    $data 		= DM_Curl::HTTPPost(array('docID'=>$getID),'get-property-by-guid');
    $propertyData 	= json_decode($data);
    if(!empty($propertyData) && $propertyData->status == "success" && !empty($propertyData->data) && $propertyData->data != null ) {
        $upload_dir   = wp_upload_dir();
        $file_relative_path = "/ca_sign_documents/" . $getID;
        $file_path = $upload_dir['basedir'] . $file_relative_path;

        $property_name = '';
        $clientname = '';

        $property_name = $propertyData->data->Name;

        $clientname = $propertyData->data->contactname;

        $fileName = 'Executed CA_'. $property_name . $clientname .'.pdf';

        header('Content-type:application/pdf');
        header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header("X-Content-Type-Options: nosniff");
        header("Content-Disposition:attachment;filename=".$fileName."");
        header('Content-Length: '.filesize( $file_path ));
        readfile($file_path);
    } else {
        wp_redirect( site_url() );
        exit;
    }
} else {
    wp_redirect( site_url() );
    exit;
}
?>
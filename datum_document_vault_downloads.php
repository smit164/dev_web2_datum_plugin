<?php 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
require_once(dirname(__FILE__).'/includes/class-dm-curl.php');
global $wpdb, $single_property, $datum_user;;
error_reporting(0);
if(isset($_POST['dv_folderid']) && $_POST['dv_folderid']) {
    $propertyId = $_POST['dv_folderid'];
    $propertyName = $_POST['dv_filename'];

    $property_id = $_GET['p_id'];
    $id = "property/".$propertyId;
    $data = DM_Curl::HTTPGet($id);
    $property = json_decode($data);
    $single_property = $property->data;

    $data = DM_Curl::HTTPGet('user');
    $datum_user = json_decode($data);
    $upload_dir = wp_upload_dir();

    $dir = $upload_dir['basedir']."/PropertyDocumentVault/";

    $upload = wp_upload_dir();
    $zip_folder_path = $upload['basedir'].'/document_vault_zip';
    if(!is_dir($zip_folder_path)) {
        mkdir($zip_folder_path, 0755);
    }

    $zip_file_name = time().'.zip';


    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $user_ip = $_SERVER['REMOTE_ADDR'];
    }

    $user_id = $datum_user->Id;

    $files_arr = $_POST['oeplSelectedFileList'];
    $files_id_arr = $_POST['directoryfileid'];
    $files_cnt = count($files_arr);
    $zipcreated = FALSE;
    $document_directory_Type = $_POST['dv_documenttype'];

    switch ($document_directory_Type) {
        case 'Offering Memorandum':
            $documenttype = 'OM';
            break;
        case 'Due Diligence':
            $documenttype = 'DD';
            break;
        case 'Public':
            $documenttype = 'Unexecuted';
            $upload_dir = wp_upload_dir();

            $destination_path = $upload_dir['basedir'].'/unexecuted_ca/'.$propertyId;

            if(!is_dir($destination_path)) {
                mkdir($destination_path, 0755);
            }

            $destination_path = $upload_dir['basedir'].'/unexecuted_ca/'.$propertyId.'/'.$user_id;
            if(!is_dir($destination_path)) {
                mkdir($destination_path, 0755);
            }

            /**
             *
             * oepl_property_tracker
             * /
             */
            $tracker = DM_Curl::HTTPPost( array('property_id'=>$propertyId),'ca-property-tracking');
            break;
        default:
            $documenttype = NULL;
            break;
    }

    if($files_cnt > 0 && $user_id != 0) {
        $filepathData = str_replace(DATUM_DOCUMENTVAULT_PATH, '', datum_decode_path($dir,$files_arr[0]));

        if($files_cnt == 1 && is_file(datum_decode_path($dir,$files_arr[0]))) {
            $download_path = datum_decode_path($dir,$files_arr[0]);
            if (is_null($documenttype)) {
                if (strpos($download_path, '/Due Diligence/') !== false) {
                    $documenttype = 'DD';
                }
                if (strpos($download_path, '/High/') !== false) {
                    $documenttype = 'High';
                }
            }

            if($documenttype == 'Unexecuted') {
                $guid = md5(uniqid());
                $get_content = file_get_contents($download_path);
                $put_content = file_put_contents($destination_path.'/'.$guid, $get_content);
                $mimetype = mime_content_type($download_path);
                $filetype = NULL;
                if($mimetype == 'application/pdf'){
                    $filetype = 'PDF';
                } else {
                    $filetype = 'DOC';
                }
                if($put_content){
                    $insertArr['documentID'] = $guid;
                    $insertArr['file_type'] = $filetype;
                }
                /**
                 *
                 * wp_osd_user_properties_relationship
                 * /
                 */
                $tracker = DM_Curl::HTTPPost(array('property_id' => $propertyId),'unexecuted');
            }
            /**
             *
             * document_vault
             * /
             */
            $tracker = DM_Curl::HTTPPost(array('property_id' => $propertyId, 'document_type' => $documenttype, 'file_path' => json_encode($filepathData), 'file_type'=>'single'),'document-tracking');

            $myFile = '';
            $fh = fopen($myFile, 'a+');
            chmod($myFile, 0777);
            $stringData  = chr(13) . '=='.date('d-M-Y H:i:s').'=========================='.chr(13);
            $stringData .= 'Property ID = '.$propertyId.chr(13);
            $stringData .= 'Document Type = '.$documenttype.chr(13);
            $stringData .= 'Client IP = '.$user_ip.chr(13);
            $stringData .= 'Client ID = '.$user_id;
            fwrite($fh, $stringData);
            fclose($fh);
        } else {
            $download_path = $zip_folder_path . '/' . $zip_file_name;
            $zip = new ZipArchive;
            $zip->open($download_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

            $i = 0; $k = 0;

            foreach ($files_arr as $file) {

                $full_path = datum_decode_path($dir,$file);
                $relativePath = str_replace($dir.$propertyId.'/','',$full_path);

                if (is_file($full_path)) {

                    if (strpos($full_path, 'ftpsync_buffer') !== false) {
                        continue;
                    }

                    if (strpos($full_path, '/Due Diligence/') !== false) {
                        $documenttype = 'DD';
                    }

                    if (strpos($full_path, '/High/') !== false) {
                        $documenttype = 'High';
                    }

                    $zip->addFile($full_path, $relativePath);
                    $single_file_dowload = $full_path;

                    $insertArr = array();
                    $insertArr['property_id'] = $propertyId;
                    $insertArr['user_id'] = $user_id;
                    $insertArr['download_datetime'] = date('Y-m-d H:i:s');
                    $insertArr['directory_file_id'] = $files_id_arr[$k];
                    $insertArr['document_type'] = $documenttype;

                    if($documenttype == 'Unexecuted') {
                        $guid = md5(uniqid());
                        $get_content = file_get_contents($full_path);
                        $put_content = file_put_contents($destination_path.'/'.$guid, $get_content);

                        $filetype = NULL;

                        $mimetype = mime_content_type($full_path);

                        if($mimetype == 'application/pdf'){
                            $filetype = 'PDF';
                        } else {
                            $filetype = 'DOC';
                        }

                        if($put_content){
                            $insertArr['documentID'] = $guid;
                            $insertArr['file_type'] = $filetype;
                        }
                        /**
                         *
                         * wp_osd_user_properties_relationship
                         * /
                         */
                        $tracker = DM_Curl::HTTPPost(array('property_id' => $propertyId),'unexecuted');
                    }

                    $myFile = 'log/property_document_download.log';

                    $fh = fopen($myFile, 'a+');
                    chmod($myFile, 0777);

                    $stringData  = chr(13) . '=='.date('d-M-Y H:i:s').'=========================='.chr(13);
                    $stringData .= 'Property ID = '.$propertyId.chr(13);
                    $stringData .= 'Document Type = '.$documenttype.chr(13);
                    $stringData .= 'Client IP = '.$user_ip.chr(13);
                    $stringData .= 'Client ID = '.$user_id;
                    fwrite($fh, $stringData);
                    fclose($fh);

                    $i++;

                } else {

                    if ($relativePath !== false) {
                        $zip->addEmptyDir($relativePath);
                    }
                }
                $k++;
            }

            $fileFinalArray = [];
            foreach ($files_arr as $file) {

                $full_path = datum_decode_path($dir,$file);
                $relativePath = str_replace($dir.$propertyId.'/','',$full_path);

                if (is_file($full_path)) {

                    if (strpos($full_path, 'ftpsync_buffer') !== false) {
                        continue;
                    }

                    if (strpos($full_path, '/Due Diligence/') !== false) {
                        $documenttype = 'DD';
                    }

                    if (strpos($full_path, '/High/') !== false) {
                        $documenttype = 'High';
                    }
                    $filepathData = str_replace(DATUM_DOCUMENTVAULT_PATH, '', $full_path);
                    $fileFinalArray[] = $filepathData;
                }


            }

            /**
             *
             * document_vault
             * /
             */
            $tracker = DM_Curl::HTTPPost(array('property_id' => $propertyId, 'document_type' => $documenttype, 'file_path' => json_encode($fileFinalArray), 'file_type'=>'multiple'),'document-tracking');
            $zip->close();
            $zipcreated = TRUE;
        }

        $unlinkpath = '';
        $do_download = true;

        if(isset($i) && $i == 1) {
            $unlinkpath = $download_path;
            $download_path = $single_file_dowload;
            $file_name = end(explode('/', $download_path));
            $mime_type = mime_content_type($download_path);
            $zipcreated = FALSE;
        } else {
            $file_name = end(explode('/', $download_path));
            $mime_type = mime_content_type($download_path);
            if(isset($i) && $i == 0 && !empty($i)) {
                $do_download = FALSE;
            }
        }

        if ($mime_type == 'application/zip') {
            $file_name = $propertyName.'.zip';
        }

        if($do_download) {

            $file_name = datum_cleanStr($file_name);
            header("Content-type: ".$mime_type);
            header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: post-check=0, pre-check=0', FALSE);
            header("Content-Disposition: attachment; filename=".$file_name);
            header("Content-length: " . filesize($download_path));
            header("Pragma: no-cache");
            header("X-Content-Type-Options: nosniff");
            header("Expires: 0");
            ob_clean();
            flush();
            readfile($download_path);
        }

        if($zipcreated && $mime_type == 'application/zip') {
            unlink($download_path);
        }

        if (!empty($unlinkpath)) {
            unlink($unlinkpath);
        }

        if(!$do_download) {
            wp_redirect( getDMProperyURL() );exit;
        }

    } else {
        wp_redirect( getDMProperyURL() );exit;
    }
} else {
    wp_redirect( getDMProperyURL() );exit;
}

function datum_check_user_device() { 
	
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) { 
		return true;
	}

	return false;
}

function datum_decode_path($dir, $encode_value ) {
	return $dir.base64_decode(urldecode($encode_value));
}

function datum_cleanStr($string){
    $string = str_replace(' ', '-', $string);
    $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string);
    $string = preg_replace('/-+/', '-', $string);
    return $string;
}
?>
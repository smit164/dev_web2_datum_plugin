<style type="text/css">
    .js-error{
        font-weight: 400;
    font-size: 12px;
    color: #D22630;
    }
    .datum_modal_overlay {
        overflow-x: scroll;
        overflow-y: scroll;
    }
</style>
<?php
    global $oepl_p_id;
    $close_refresh = 'close_refresh';
    $oepl_p_id = getDMPropertyId();
    $property_name = getDMPropertyName();
    $documenttype = $documenttype;

    $foldername_arr = explode(',', $documenttype);
    ;
    $main_dir_arr = array();
    foreach ($foldername_arr as $foldername) {
        $main_dir_arr[] = DATUM_DOCUMENTVAULT_PATH.$oepl_p_id.'/'.$foldername;
    }
    $imgIconArr = array(
        'directory'					=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/folder.svg',
        'text/css'					=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/css.svg',
        'text/plain'				=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/txt.svg',
        'text/csv'					=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/csv.svg',
        'text/javascript'			=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/javascript.svg',
        'image/png'					=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/png.svg',
        'image/svg+xml'				=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/svg.svg',
        'image/jpeg'				=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/jpg.svg',
        'application/pdf'			=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/pdf.svg',
        'application/zip'			=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/zip.svg',
        'application/json'			=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/json-file.svg',
        'video/x-msvideo'			=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/avi.svg',
        'other'						=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/file.svg',
        'application/msword' 		=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/doc.svg',
        'application/vnd.ms-excel' 	=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/xls.svg',
        'image/vnd.dwg' 			=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/dwg.svg',
        'audio/mpeg'				=> DATUM_PLUGIN_IMAGES_URL.'filetype_images/mp3.svg',
        'application/vnd.ms-powerpoint' => DATUM_PLUGIN_IMAGES_URL.'filetype_images/ppt.svg',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => DATUM_PLUGIN_IMAGES_URL.'filetype_images/ppt.svg',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => DATUM_PLUGIN_IMAGES_URL.'filetype_images/doc.svg'
    );
    $filesNotFound = 0;
    $foldertype = end(explode('/', $main_dir));
?>
<style>
    .modal-dialog{
        width: 60%;
    }
    .hide_S{
        display: none;
    }
    .oepl_Folder_FileLists {margin: 5px 0;padding-left:20px;}
    .oepl_Folder_FileLists li {list-style: none;margin: 5px 0;}
    .oepl_Folder_FileLists li label {cursor: pointer;}
    /* Hide Show Folder Structure CSS */
    .oepl_main_folder {cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}
    .oepl_main_folder::before {content: "\25B6";color: #000F9F;display: inline-block;margin:0 6px;vertical-align: top;-ms-transform: rotate(90deg);-webkit-transform: rotate(90deg);transform: rotate(90deg);}
    .oepl_down_arrow::before {-ms-transform: rotate(0deg);-webkit-transform: rotate(0deg);transform: rotate(0deg);}
    .oepl_sub_folder {display: block;}
    .oepl_folder_closed {display: none;}
</style>
<div class="datum_modal_wrapper datum_modal_transition">
    <div class="datum_login_popupbox datum_documnetvault_popup">
        <h2><?php  _e("Document Vault",'datum'); ?></h2>
        <a class="datum_login_close" href="javascript:void(0);">&times;</a>
        <div class="datum_login_content">
            <div class="">
                <div class="datum_login_content">
                    <div class="modal-body" id="dd_documentvault" style="padding-top:0;">
                        <div class="datum_row">
                            <div class="demo-section k-content model-scroll-section oepl_tree_row" style="margin-bottom: 20px;">
                                <?php foreach ($main_dir_arr as $main_dir) { ?>
                                    <ul class="oepl_Folder_FileLists">
                                        <li>
                                            <?php
                                            $checkbox_html = '
                                            <label class="kt-checkbox">
                                                <input class="oepl_checkbox oepl_main_dir" id="oepl_select_all" type="checkbox" data-directoryfileid="" name="files[]" value="'.urlencode(base64_encode(str_replace(DOCUMENTVAULT_PATH, '', $main_dir))).'"/>
                                                <span class="k-checkbox-label checkbox-span"></span>
                                            </label>';

                                            if(is_dir($main_dir) && file_exists($main_dir)) {
                                                $main_dir_arr = scandir($main_dir);
                                                unset($main_dir_arr[array_search('.', $main_dir_arr, true)]);
                                                unset($main_dir_arr[array_search('..', $main_dir_arr, true)]);

                                                if(count($main_dir_arr) == 0) {
                                                    $checkbox_html = '';
                                                }
                                            } else {
                                                $checkbox_html = '';
                                            }
                                            echo $checkbox_html;

                                            ?>
                                            <span class="oepl_main_folder">
                                            <label><?php echo end(explode('/', $main_dir)); ?></label>
                                            </span>
                                            <?php
                                            if(is_dir($main_dir) && file_exists($main_dir)) {
                                                if(count($main_dir_arr) == 0) {
                                                    echo '<ul class="oepl_Folder_FileLists oepl_sub_folder"><li><div style="color:#000F9F;">No record found.</div></li></ul>';
                                                } else {
                                                    $filesNotFound = $filesNotFound + 1;
                                                    oepl_list_Folder_Files($main_dir, $imgIconArr);
                                                }
                                            } else {
                                                echo '<ul class="oepl_Folder_FileLists oepl_sub_folder"><li><div style="color:#000F9F;">No record found.</div></li></ul>';
                                            }
                                            ?>
                                        <li>
                                    </ul>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="datum_right_alignment">
                            <?php if( $documenttype == 'Public') {  ?>
                                <button class="datum_btn_primary btn-lg" id="back-toagrement" type="button" data-property_id="<?php echo $oepl_p_id; ?>"><?php  _e("Back",'datum'); ?></button>
                            <?php } ?>
                            <button onclick="oeplDownloadFiles();" class="datum_btn_primary btn-lg <?php if($filesNotFound == 0) { echo 'datum_desabled'; } ?>" id="download_document_valut" type="button" <?php if($filesNotFound == 0) { echo 'disabled'; echo 'style="cursor: not-allowed; opacity: 0.7;"'; } ?>><?php  _e("Download",'datum'); ?></button>
                        </div>
                    </div>
                </div>
                <?php
                    ## recursive function to create folder structure
                    function oepl_list_Folder_Files( $dir, $imgIconArr ) {

                        global $oepl_p_id;
                        $ffs = scandir($dir);

                        unset($ffs[array_search('.', $ffs, true)]);
                        unset($ffs[array_search('..', $ffs, true)]);

                        echo '<ul class="oepl_Folder_FileLists oepl_sub_folder">';

                        if(count($ffs) > 0) {
                            foreach($ffs as $ff) {

                                if (strpos($ff, 'ftpsync_buffer') !== false) {
                                    continue;
                                }

                                $path = $dir.'/'.$ff;
                                $mime_type = mime_content_type($path);

                                if(!empty($mime_type) && array_key_exists($mime_type, $imgIconArr)) {
                                    $img = '<img src="'.$imgIconArr[$mime_type].'" width="20"/>';
                                } else {
                                    $img = '<img src="'.$imgIconArr['other'].'" width="20"/>';
                                }

                                $itis_dir = true;
                                $directory_fileID = '';
                                if(!is_dir($path)) {
                                    $itis_dir = false;
                                    $filepath1 = str_replace(DATUM_DOCUMENTVAULT_PATH, '', $path);
                                    $filepath_arr1 = explode('/', $filepath1);
                                    $filename1 = end($filepath_arr1);
                                    $postData = array(
                                        'property_id' => $oepl_p_id,
                                        'filepath' => $path,
                                        'filename' => $filename1,
                                        'dir_path' => DATUM_DOCUMENTVAULT_PATH
                                    );
                                    $directoryFileID = 0;
                                    if( isset( $directoryFileID->DirectoryFileId ) && $directoryFileID->DirectoryFileId != '') {
                                        $directory_fileID = $directoryFileID->DirectoryFileId;
                                    }
                                }
                                $base64_encode_path = urlencode(base64_encode(str_replace(DATUM_DOCUMENTVAULT_PATH, '', $path)));

                                echo '<li>';

                                $checkbox_html = '<label class="kt-checkbox">';
                                $checkbox_html .= '<input class="oepl_checkbox" type="checkbox" name="files[]" data-directoryfileid="'.$directory_fileID.'" value="'.$base64_encode_path.'"/><span class="k-checkbox-label checkbox-span">';
                                $checkbox_html .= '</span></label>';

                                if($itis_dir) {
                                    $folder_files_arr = scandir($path);
                                    unset($folder_files_arr[array_search('.', $folder_files_arr, true)]);
                                    unset($folder_files_arr[array_search('..', $folder_files_arr, true)]);

                                    $no_toggle = 'oepl_main_folder';
                                    if(count($folder_files_arr) == 0) {
                                        $checkbox_html = '';
                                        $no_toggle = '';
                                    }
                                }
                                echo $checkbox_html;

                                if($itis_dir) {
                                    echo '<span class="'.$no_toggle.'">';
                                }

                                echo '<label><span style="vertical-align: middle;padding: 5px;">'.$img.'</span>'.$ff.'</label>';

                                if($itis_dir) {
                                    echo '</span>';
                                    echo oepl_list_Folder_Files($path, $imgIconArr);
                                }
                                echo '</li>';

                            }
                        }
                        echo '</ul>';
                    }

                    ?>
            </div>
        </div>
    </div>
</div>
<form id="oeplDocumentVault" method="post" action="<?php echo DATUM_PLUGIN_URL; ?>datum_document_vault_downloads.php">
</form>
<script>
    $(document).ready(function(){
        var toggler = document.getElementsByClassName("oepl_main_folder");
        var i;
        for (i = 0; i < toggler.length; i++) {
           toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".oepl_sub_folder").classList.toggle("oepl_folder_closed");
            this.classList.toggle("oepl_down_arrow");
           });
        }
        $("#download_document_valut").prop("disabled", true);
        $("#download_document_valut").css({"cursor":"not-allowed", "opacity":"0.7"});
    });

   $(function() {
        $(".oepl_checkbox").change(function(e) {
            var checked = $(this).prop("checked"),
            container = $(this).parent().parent(),
            siblings = container.siblings();
            container.find(".oepl_checkbox").prop({
                indeterminate: false,
                checked: checked
            });

            function checkSiblings(el) {
                var parent = el.parent().parent(),
                all = true;

                el.siblings().each(function() {
                    return all = ($(this).children('label').find('.oepl_checkbox').prop("checked") === checked);
                });

                if (all && checked) {
                    parent.children('label').find('.oepl_checkbox').prop({
                        indeterminate: false,
                        checked: checked
                    });
                    checkSiblings(parent);
                } else if (all && !checked) {
                    parent.children('label').find('.oepl_checkbox').prop("checked", checked);
                    parent.children('label').find('.oepl_checkbox').prop("indeterminate", (parent.find(".oepl_checkbox:checked").length > 0));
                    checkSiblings(parent);
                } else {
                    el.parents("li").children('label').find('.oepl_checkbox').prop({
                        indeterminate: true,
                        checked: false
                    });
                }
           }
           checkSiblings(container);
       });
   });
   // Select all child folder or file END

   $(document).on("change", ".oepl_checkbox", function(e) {
        var checked_length = $(".oepl_checkbox:checked").length;
        var download_btn_ID = "#download_document_valut";

        if(checked_length > 0){
            $(download_btn_ID).prop("disabled", false);
            $(download_btn_ID).css({"cursor":"pointer", "opacity":"1"});
        } else {
            $(download_btn_ID).prop("disabled", true);
            $(download_btn_ID).css({"cursor":"not-allowed", "opacity":"0.7"});
        }
   });

   function oeplDownloadFiles() {

       $("#download_document_valut").html("DOWNLOADING...");

       $( ".oepl_checkbox" ).each(function() {
          if($(this).is(":checked")) {
              var encoded_file_name = this.value;
              var directoryfileid = $(this).data('directoryfileid');
              $('#oeplDocumentVault').append('<input type="hidden" name="oeplSelectedFileList[]" value="' + encoded_file_name + '" />');
              $('#oeplDocumentVault').append('<input type="hidden" name="directoryfileid[]" value="' + directoryfileid + '" />');
          }
      });

       $("#oeplDocumentVault").append('<input type="hidden" name="dv_filename" value="<?php echo $property_name; ?>" />');
       $("#oeplDocumentVault").append('<input type="hidden" name="dv_folderid" value="<?php echo $oepl_p_id; ?>" />');
       $("#oeplDocumentVault").append('<input type="hidden" name="dv_documenttype" value="<?php echo $documenttype; ?>" />');

       $("#oeplDocumentVault").submit();
       $("#oeplDocumentVault").empty();
       $(".oepl_checkbox").prop({indeterminate: false,checked: false});

       $("#download_document_valut").prop("disabled", true);
       $("#download_document_valut").css({"cursor":"not-allowed", "opacity":"0.7"});
       setTimeout(function(){
            $('#download_document_valut').html('Download');
            $("#download_document_valut").prop("disabled", false);
            $('#download_document_valut').removeAttr("style");
            $("#download_document_valut").prop("disabled", true);
            $("#download_document_valut").css({"cursor":"not-allowed", "opacity":"0.7"});
            //loadinghide();
            //location.reload();
       }, 2000);
  }
  var ajaxCount = 1;
  jQuery(document).on('click','#back-toagrement',function(e){
        var property_id = $(this).attr('data-property_id');
        var open_un_ex = ajax_url+'?action=popuphtml';
        if( ajaxCount > 1) {
            return false;
        }
        ajaxCount = ajaxCount + 1;
        jQuery.ajax({
            type    : 'POST',
            url     : open_un_ex,
            data    : {'popuphtml':'login_html', property_id: parseInt(property_id)} ,
            dataType: 'json',
            async: true,
            beforeSend : function() {
                loadingshow();
            },
            success : function(res) {
            switch(res.data.type) {
                    case 'success' :
                        $('#datum_popup_html').html(res.data.html);
                        break;
                    case 'failure' :
                        for(var i in res.data.html) {
                            var msgs = '';
                            if(res.data.html[i].length) {
                                jQuery("#"+ i ).html(msgTemplate.replace(/{{type}}/g, 'danger').replace(/{{msg}}/g, res.data.html[i]));
                                jQuery("."+ i ).addClass('alert-text');
                            }
                        }
                        break;
                    default :
                        break;
                }
            },
            complete : function() {
                loadinghide();
            }
        });
    });
</script>
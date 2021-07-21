<?php
   if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
        if(getDMPropertyIsPressReleaseFile() == 1){ 
            if(!empty(getDMPropertyPressReleaseFilepath())){ ?>
                <a href="" id="press_release_login" data-property_id='<?php echo getDMPropertyId(); ?>' class="datum_btn_grey" style="text-decoration: none;"><img src="<?php echo DATUM_PLUGIN_URL ?>images/icons/lock.svg"> Press Release</a>
            <?php
            }
            else{ ?>
                <?php 
            }
        }else{
            if(!empty(getDMPropertyPressReleaseLink())){ ?>
                <a href="<?php echo getDMPropertyPressReleaseLink(); ?>" target="_blank" data-property='<?php echo getDMPropertyId(); ?>' class="datum_btn_grey" style="text-decoration: none;"><img src="<?php echo DATUM_PLUGIN_URL ?>images/icons/lock.svg"> Press Release</a>
            <?php 
            }
        }
    }else{
        if(getDMPropertyIsPressReleaseFile() == 1){ 
            if(!empty(getDMPropertyPressReleaseFilepath())){ ?>
                <a data-popup="login_html" id="" data-type="press_release" data-property_id='<?php echo getDMPropertyId(); ?>' class="datum_btn_grey datum_modal_toggle datum_model_open" style="text-decoration: none;"><img src="<?php echo DATUM_PLUGIN_URL ?>images/icons/lock.svg"> Press Release</a>
            <?php
            }
            else{ ?>
                <?php 
            }
        }else{
            if(!empty(getDMPropertyPressReleaseLink())){ ?>
                <a data-popup="login_html" id="" data-type="press_release" href="<?php echo getDMPropertyPressReleaseLink(); ?>" data-property_id='<?php echo getDMPropertyId(); ?>' class="datum_btn_grey datum_modal_toggle datum_model_open" style="text-decoration: none;"><img src="<?php echo DATUM_PLUGIN_URL ?>images/icons/lock.svg"> Press Release</a>
            <?php 
            }
        }
    }
?>
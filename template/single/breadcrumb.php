<div class="datum_breadcrumb_div">
    <ul>
        <?php
            $property_type = explode(',' ,$single_property->property_type);
            $post_name  = get_post(get_option('datum_property_listing_id'));
            $post_type  = get_post(get_option('datum_property_type_id'));
        ?>
        <li> <a href="<?php echo home_url(); ?>">Home</a></li>
        <li> <a href="<?php echo getDMProperyMainURL(); ?>"><?php echo get_the_title(); ?></a></li>
        <li> <a href="#"><?php echo getDMPropertyPropertyStatus();  ?></a></li>
        <li class="active"><?php echo getDMPropertyName(); ?></li>
    </ul>
    <div class="datum_property_actions">
        <?php
        $favorites = false;
        if(isset($single_property->favorite) && $single_property->favorite != '' && $single_property->favorite == 1) {
            $favorites = true;
        }
        ?>
        <ul>
            <li>
                <label class="datum_star_toggle datum_model_open" data-popup="favorite_popup" id="datum_property_id_<?php echo getDMPropertyId(); ?>" data-property_id="<?php echo getDMPropertyId(); ?>">
                    <input type="checkbox" <?php if($favorites) { echo 'checked'; }?>>
                    <div class="datum_icon">
                        <div class="datum_star"> </div>
                    </div>
                </label>
            </li>
            <li> 
                <div class="datum_share_icon">
                    <div data-popup="share_property" data-property_id="<?php echo getDMPropertyId(); ?>" class="datum_share_button datum_modal_toggle datum_model_open" id="datum_share_button">
                        <img src="<?php echo plugins_url()?>/datum/images/icons/social/share.svg">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
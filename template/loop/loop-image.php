<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $property_post;
?>
<div class="datum_img-box">
    <div class="datum_slick_carousel slider">
        <?php		
        if(!empty(getDMOtherImage())){  ?>
            <?php
                foreach (getDMOtherImage() as $img_name) {
					echo '<a href="'.getDMProperyURL().'">';
                    ?>
                    <div>
                        <div class="slide-content">
                        <img src="<?php echo $img_name; ?>">
                        </div>
                    </div>
                    <?php
					echo '</a>';
                }
            ?>
        <?php } else if(!empty(getDMPropertyFeaturedImage())) { 
			echo '<a href="'.getDMProperyURL().'">';
		?>
            <div>
                <div class="slide-content">
                    <img src="<?php echo getDMPropertyFeaturedImage(); ?>">
                </div>
            </div>
        <?php echo '</a>';
		} else {
			echo '<a href="'.getDMProperyURL().'">';
		?>
            <div>
                <div class="slide-content">
                    <img src="https://cdn.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_960_720.jpg">
                </div>
            </div>
        <?php 
			echo '</a>';
        }
        ?>
    </div>
    <?php
    $favorites = false;
    if(isset($property_post->favorite) && $property_post->favorite != '' && $property_post->favorite == 1) {
        $favorites = true;
    }
    ?>
    <label class="datum_star_toggle datum_model_open" data-popup="favorite_popup" id="datum_property_id_<?php echo getDMPropertyId(); ?>" data-property_id="<?php echo getDMPropertyId(); ?>" data-listing="property">
        <input type="checkbox" <?php if($favorites) {echo 'checked'; }?>/>
        <div class="datum_icon">
            <div class="datum_star"> </div>
        </div>
    </label>
<!--     <span class="datum_property_type_label">Collab</span>  -->
</div>
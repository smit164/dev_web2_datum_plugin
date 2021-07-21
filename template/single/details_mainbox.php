<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion datum will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="datum_details_strap datum_d_sm_none" id="section1">
    <div class="datum_pdp_details_mainbox">
        <ul>
            <?php
                if( !empty ( getDMpropertyHighlights() ) ) {
                    foreach ( getDMpropertyHighlights() as $key => $value ) {
                        ?>
                        <li>
                            <div class="datum_pdp_detail_box">
                                <img class="<?php echo $value->name; ?>" src="<?php echo $value->icon; ?>" alt="<?php echo $value->name; ?>" loading="lazy">
                                <h3 class="<?php if ( strlen($value->field) >= 15) { echo "text_too_big"; } ?>"><?php echo $value->field; ?></h3>
                                <p class="<?php echo $value->class; ?>"><?php echo $value->lable; ?></p>
                            </div>
                        </li>
                        <?php
                    }
                }
            ?>
        </ul>
    </div>
</section>
<section class="datum_details_strap datum_d_sm_block datum_d_none">
    <div class="datum_details_strap_slider slider">
        <?php
            if( !empty ( getDMpropertyHighlights() ) ) {
                foreach ( getDMpropertyHighlights() as $key => $value ) {
                ?>
                    <div class="slide-item">
                        <div class="datum_pdp_detail_box">
                            <img class="<?php echo $value->name; ?>" src="<?php echo $value->icon; ?>" alt="<?php echo $value->name; ?>" loading="lazy">
                            <h3 class="<?php if (strlen($value->field) >= 15) { echo "text_too_big"; } ?>"><?php echo $value->field; ?></h3>
                            <p class="<?php echo $value->class; ?>"><?php echo $value->lable; ?></p>
                        </div>
                    </div>
                <?php
                }
            }
        ?>
    </div>
</section>
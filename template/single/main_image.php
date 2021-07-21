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
global $single_property;

?>
<section class="datum_banner_section">
    <div class="datum_banner_image">
    	<?php if(getDMPropertyMainVideo() != '') { ?>
    		<iframe width="100%" class="pdp_banner_youtube" height="900px" src="https://www.youtube.com/embed/<?php echo $single_property->main_video; ?>?autoplay=1&showinfo=0&rel=0&iv_load_policy=3&fs=0&controls=1&disablekb=1&mute=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
    	<?php } else if(getDMPropertyBannerImage() != '') { ?>
        	<picture> <img src="<?php echo getDMPropertyBannerImage(); ?>" alt="<?php echo getDMPropertyImageAltText(); ?>" class="img-responsive"></picture>
    	<?php }else{ ?>
        	<picture> <img src="https://datumdocstorage.blob.core.windows.net/datumfilecontainer/placeholders/listing-img-placeholder.jpg" alt="listing-img-placeholder" class="img-responsive"> </picture>
    	<?php }
    	?>
        <div class="datum_gradient_below_text">
            <div class="datum_banner_text">
                <h1><?php echo getDMPropertyName(); ?><span>
                    <?php echo getDMPropertyAddress1(); ?><br><?php echo getDMPropertyCity(); ?>, <?php echo getDMPropertyState(); ?> <?php echo getDMPropertyZipcode(); ?></span></h1>
                <a href="#section1" class="scroll"><img src="<?php echo DATUM_PLUGIN_URL ?>images/icons/down-arrow-white.svg" alt="" loading="lazy"></a>
            </div>
        </div>
    </div>
</section>
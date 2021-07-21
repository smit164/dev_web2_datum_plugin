<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $single_property;

$statusdate = strtotime($single_property->status_date);
$statusdate = date("n/j/Y", $statusdate);

if($single_property->property_status == 'Offers Due') {
    $propertystatus = 'Offers Due '.$statusdate;
}
?>
<div class="datum_position_relative">
    <div class="slider slider-for" id="datum_feature_slider">
        <?php
        if(!empty(getDMOtherImage())){
            foreach (getDMOtherImage() as $img_name) { ?>
                <div data-download-url=false data-src="<?php echo $img_name; ?>" >
                    <a href=""> <img src="<?php echo $img_name; ?>" class="img-responsive datum_slider_img" loading="lazy"/> </a>
                </div>
            <?php }
        }
        ?>
    </div>
    <div class="" id="property_single_map" style="display: none; height: 473px;">
        
    </div>
    <div class="" id="property_panorma_single" style="display: none; height: 473px;">
        
    </div>

    <a href="javascript:void(0);" id="street-icon" class="street-icon"> <img src="<?php echo plugins_url() ?>/datum/images/icons/street view.svg" alt="slider" loading="lazy">
        <p>Street View</p>
    </a>
    <a href="javascript:void(0);" class="gallary-icon">
        <img src="<?php echo plugins_url() ?>/datum/images/icons/gallary-icon.png" alt="slider" loading="lazy">
        <p>Gallery</p>
    </a>

    <a href="javascript:void(0);" id="location-icon" class="location-icon">
        <img src="<?php echo plugins_url() ?>/datum/images/icons/location-icon.png" loading="lazy">
        <p>Map</p>
    </a>
</div>
<script type="text/javascript">
    $(document).on('ready', function() {
        var market = '{"latitude":<?php echo getDMPropertyLatitude(); ?>,"longitude":"<?php echo getDMPropertyLongitude() ?>","title":"<?php echo getDMPropertyName(); ?>"}';
        propertysingmap.setup({
            marker : market,
        });
        $('.location-icon').click(function(e){
            e.preventDefault();
            $('#property_panorma_single').hide();
            $('#datum_feature_slider').hide();
            $('#property_single_map').show();
        });

        $('.gallary-icon').click(function(e){
            e.preventDefault();
            $('#property_panorma_single').hide();
            $('#datum_feature_slider').show();
            $('#property_single_map').hide();
        });


        $('#street-icon').click(function(e){
            e.preventDefault();
            propertysingmap.setMapTypeId(market);
            $('#property_panorma_single').show();
            $('#datum_feature_slider').hide();
            $('#property_single_map').hide();
        });
    });
</script>
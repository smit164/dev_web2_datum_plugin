<?php
get_header();
global $favritesProperty,$single_property;
if (!empty($single_property->sq_feet)) {
    $sq_feet = number_format($single_property->sq_feet);
}else{
    $sq_feet = '-';
}
?>
<?php do_action('datum_banner_section'); ?>
<div class="datum_wrapper">
    <section class="my-faverite-listing-page" id="section1">
        <div class="datum_row" id="my-faverite-listing-page">
            <?php 
            include 'mylisting/favritesProperty.php';
            ?>
        </div>
    </section>
</div>
<?php
include 'login.php';
get_footer();
?>

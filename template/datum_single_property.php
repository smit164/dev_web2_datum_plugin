<?php
    get_header();
    global $single_property;
?>
<style type="text/css">
    .datum_headline:before{
        display: none;
    }
    p:empty:before{
        display:none !important;
    }
        h2:empty:before{
        display:none !important;
    }
    h2:before{
        display:none !important;
    }
    .datum_main_form_container[disabled]{
        cursor: not-allowed;
        background-color: #eee;
        opacity: 1;
    }
    .hide_s{
        display:none !important;
    }

</style>
<?php
$userId = '';
if(!empty($datum_user) && $datum_user != '') {
    $userId = $datum_user->id;
}
?>
<div class="datum_page_content">
    <?php
        // main_image.php
        do_action('datum_single_main_content');

        //details_mainbox.php
        do_action('datum_single_main_mainbox');
    ?>
    <div class="datum_wrapper">
        <?php
        include 'single/breadcrumb.php'
        ?>
        <?php do_action('datum_single_offering_summary'); ?>



        <div class="datum_row mt-50 pb-50">
            <div class="datum_deskdevice_6 datum_rp_15">
                <div class="feature-info datum_d_sm_none">
                    <h2 class="datum_headline">Description</h2>
                    <div id="datum_nkf_theme_content">
                        <p></p>
                        <p><?php echo getDMPropertyPropertyContent(); ?></p>
                        <p></p>
                    </div>
                </div>
            </div>
            <?php echo do_action('datum_single_deal_team'); ?>
        </div>
    </div>
    <div class="">
        <?php //echo do_shortcode('[dm_social]') ?>
    </div>
<?php
include 'login.php';
include 'loading.php';
?>
</div>
<script type="text/javascript">
    
    //jQuery(document).on('click','.sharing_datum',function(e){
        function fbShare(url, title, descr, image, winWidth, winHeight) {
            var winTop = (screen.height / 2) - (winHeight / 2);
            var winLeft = (screen.width / 2) - (winWidth / 2);
            window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
        }
   // });
    jQuery(document.body).on('click', '.ess-social-share', function () {
        var top = jQuery(window).height() / 2 - 450 / 2, left = jQuery(window).width() / 2 - 550 / 2,
            new_window = window.open($(this).attr('href'), '', 'scrollbars=1, height=450, width=550, top=' + top + ', left=' + left);
        if ( window.focus ) {
            new_window.focus();
        }
        return false;
    });
</script>
<?php
get_footer();
?>
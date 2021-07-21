<?php
get_header();
    
?><style type="text/css">
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
</style>
<div class="datum_page_content">
<?php
    do_action('datum_property_type');

    datum_property_loop_start();
            //if(datum_property_lits()){
                
            //}
    datum_property_loop_end();
?>
</div>
<?php
include 'loading.php';
get_footer();
?>
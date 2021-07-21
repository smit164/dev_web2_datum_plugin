<?php
get_header();
?>
<div class="datum_page_content">
<?php
    do_action('datum_property_type');

    datum_property_loop_start();

    datum_property_loop_end();
?>
</div>
<?php
get_footer();
?>
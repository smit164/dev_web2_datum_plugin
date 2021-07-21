<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div  class="datum_project_detail">
    <div class="datum_project_title">
        
        <?php
            do_action('datum_loop_title');
            
            do_action('datum_loop_price');
        ?>
    </div>
    <div class="datum_sub-detail">
        <div class="datum_project_type"><?php echo getDMPropertyPropertyStatus(); ?></div>
        <?php do_action('datum_loop_due_date'); ?>
    </div>
</div>
<?php
echo '</a>';
?>
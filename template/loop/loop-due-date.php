<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$propertystatus = getDMPropertyListingStatusOnly();
if (getDMPropertyListingStatusOnly() == 'Offers Due') {
    //$propertystatus = getDMPropertyListingStatus() .' '.getDMPropertyStatusDate();
    $propertystatus = getDMPropertyListingStatus();
}
?>
<div class="datum_due_date"><?php echo  $propertystatus;?></div>
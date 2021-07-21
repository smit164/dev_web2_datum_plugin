<?php
include 'exchange.php';
?>
<div class="datum_row">
<?php
	/*$property_type = 
		array(
		'PropetyType' 			=> 'Preferred Property Type',
		'PeferredMarketType' 	=> 'Preferred Markets',
		'InvestmentStraragy' 	=> 'Investment Strategy',
		'ReturnMetrics'		=> 'Preferred Return Metrics',
		'PrefferedDealSize'		=> 'Preferred Deal Size',
	);*/

	include 'PropetyType.php'; 
	include 'PeferredMarketType.php'; 
	include 'InvestmentStraragy.php'; 
	include 'ReturnMetrics.php'; 
	include 'PrefferedDealSize.php'; 

?>
</div>
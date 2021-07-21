<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $single_property;
if(empty($single_property->property_images)){
    $property_image = array('s','s');
}else{
    $property_image = json_decode($single_property->property_images);
}
$arr_askingprice = getDMPropertyAskingPrice();
if (getDMPropertyIsUnpriced() == 1) {
    $arr_askingprice = 'Unpriced';
}


$p_details_add = array(
    'Pricing' => array(
        0 => array( 
            'Asking Price'      => getDMPropertyAskingPrice(),
            'Price PSF'         => getDMPropertyPricePsf(),
            'Price/Unit'        => '$'.number_format($single_property->price),
            'WALT'              => getDMPropertyWalt(),
            'Cap Rate'          => getDMPropertyYear1CapRate(),
            'NOI'               => getDMPropertyYear1Noi(),
            'In-Place Cap Rate' => getDMPropertyInPlaceCapRate(),
            'In-Place NOI'      => getDMPropertyInPlaceNoi(),
            'T12 Cap Rate'      => getDMPropertyT12Caprate(),
            'T12 NOI'           => '',
            //'In-Place Rents' => '$'.number_format($single_property->In_place_rents),
            //'Market Rents' => '$'.number_format($single_property->market_rents),
            'Rents Below Market' => getDMPropertyAvgInplaceRentsBelowMarket(),
            'Mark-to Market Cap Rate' => getDMPropertyMarkToMarketCapRate(),
            'GRM'               => getDMPropertyGrm(),
            'Potential GRM'     => getDMPropertyPotentialGrm(),
            'Investment Period' => getDMPropertyInvestmentPeriod(),
            'Unlevered IRR'     => getDMPropertyUnleveredIrr(), 
            'Levered IRR'       => getDMPropertyLeveredIrr(),
            'Equity Multiple'   => getDMPropertyYr10EquityMultiple().'X',
            'Cash-on-Cash'      => getDMPropertyCashOnCash().'%',
            'Return on Cost'    => getDMPropertyReturnOnCost(),        
        ),
    ),
    'Details' => array(
        0 => array( 
            //'Property Type' =>  str_replace('Flex','R&D/Flex',str_replace(',',' | ', $single_property->property_type)),
            'Property Type'     => getDMPropertyPropertyStatus(),
            'Property Status'   => getDMPropertyListingStatus(),
            //'Call for Offers'   => date("m/d/Y", strtotime(getDMPropertyStatusDate())),
            'Square Feet'       => number_format(getDMPropertySqFeet()),
            'Units'             => getDMPropertyUnits(),
            'Occupancy'         => getDMPropertyOccupancy(),
            'Year Built'        => getDMPropertyYearBuilt(),
            'Year Renovated'    => getDMPropertyYearRenovated(),
            'Capital Invested'  => '$'.number_format(getDMPropertyCapitalInvested()),
            'Building Class'    => getDMPropertyBuildingClass(),
            'Building(s)'       => getDMPropertyBuilding(),
            'Stories'           => getDMPropertyStories(),
            'Parking Ratio'     => getDMPropertyParkingRatio(),
            'Acres'             => number_format(getDMPropertyLotSize(),2),         
            'Zoning'            => getDMPropertyZoning(),
            'APN'               => getDMPropertyApn(),
            'Tenancy'           => getDMPropertyTenancy(),
            'Lease Type'        => $single_property->lease_type,
        ),
    ),
);
?>
<?php
foreach ($p_details_add as $key => $value) {
	echo '<div class="basic-detail">';
	    echo '<h4 class="headline">'.$key.'</h4>';
	    echo '<ul>';
	        foreach ($value as $k1 => $v1) {
	        	echo '<div class="innerDiv">';
	        		foreach ($v1 as $k => $v) {
	        			if ($v == '' || empty($v) || $v == '$' || $v == '0' || $v == '$0' || $v == '0.00%' || $v == '0%' || $v == '0.00X' || $v == '0 Years' || $v == '0.00 Years' || $v == '0.0%') 
						{
							if ($k == 'Occupancy' && getDMPropertyTenancy() == 'Vacant') {
	            				echo '<li>'._e($k,'datum').'<span>'.$v.'</span></li>';
							}
						}else{
	            			echo '<li>'._e($k,'datum').'<span>'.$v.'</span></li>';

						}
	        		}
	        	echo '</div>';
	        }
	    echo '</ul>';
	echo '</div>';
}
?>
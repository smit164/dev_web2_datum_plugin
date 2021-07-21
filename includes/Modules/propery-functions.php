<?php



/**
 * ID
 */
if (!function_exists("getDMPropertyId")) {
    function getDMPropertyId($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ID != "") {
            return $single_property->ID;
        } else {
            return;
        }
    }
}

/**
 * END
 * Clientname
 */
if (!function_exists("getDMPropertyClientname")) {
    function getDMPropertyClientname($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->clientname != "") {
            return $single_property->clientname;
        } else {
            return;
        }
    }
}
//END//Name
if (!function_exists("getDMPropertyName")) {
    function getDMPropertyName($args = array())
    {
        global $single_property;
        global $single_property;
        if (isset($single_property) && $single_property->Name != "") {
            return $single_property->Name;
        } else {
            return;
        }
    }
}
//END//CreatedDate
if (!function_exists("getDMPropertyCreatedDate")) {
    function getDMPropertyCreatedDate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CreatedDate != "") {
            return $single_property->CreatedDate;
        } else {
            return;
        }
    }
}
//END//ModifiedDate
if (!function_exists("getDMPropertyModifiedDate")) {
    function getDMPropertyModifiedDate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ModifiedDate != "") {
            return $single_property->ModifiedDate;
        } else {
            return;
        }
    }
}
//END//PropertyType
if (!function_exists("getDMPropertyPropertyType")) {
    function getDMPropertyPropertyType($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->property_type != "") {
            return str_replace(',',' | ', $single_property->property_type);
        } else {
            return;
        }
    }
}
//END//PropertyStatus
if (!function_exists("getDMPropertyPropertyStatus")) {
    function getDMPropertyPropertyStatus($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PropertyType != "") {
            return $single_property->PropertyType;
        } else {
            return;
        }
    }
}

if (!function_exists("getDMPropertyListingStatusOnly")) {
    function getDMPropertyListingStatusOnly($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ListingStatus != "") {
			return $single_property->ListingStatus;
       } else {
            return;
        }
    }
}

if (!function_exists("getDMPropertyListingStatus")) {
    function getDMPropertyListingStatus($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ListingStatus != "") {
            if($single_property->ListingStatus == 'Offers Due'){
				return $single_property->ListingStatus.' '.getDMPropertyStatusDate();
			} else {
				return $single_property->ListingStatus;
			}
        } else {
            return;
        }
    }
}
//END//StatusDate
if (!function_exists("getDMPropertyStatusDate")) {
    function getDMPropertyStatusDate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->StatusDate != "") {
			return date("n/j/Y", strtotime($single_property->StatusDate));
        } else {
            return;
        }
    }
}
//END//Occupancy
if (!function_exists("getDMPropertyOccupancy")) {
    function getDMPropertyOccupancy($args = array())
    {
        global $single_property;
        if (isset($single_property) && ($single_property->Occupancy != "" || $single_property->Occupancy == "0.00")) {
            return $single_property->Occupancy .'%';
        } else {
            return;
        }
    }
}
//END//SqFeet
if (!function_exists("getDMPropertySqFeet")) {
    function getDMPropertySqFeet($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->SqFeet != "") {
            return $single_property->SqFeet;
        } else {
            return;
        }
    }
}
//END//YearBuilt
if (!function_exists("getDMPropertyYearBuilt")) {
    function getDMPropertyYearBuilt($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->YearBuilt != "") {
            return $single_property->YearBuilt;
        } else {
            return;
        }
    }
}
//END
//Building
if (!function_exists("getDMPropertyBuilding")) {
    function getDMPropertyBuilding($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Building != "") {
            return $single_property->Building;
        } else {
            return;
        }
    }
}
//END//LotSize
if (!function_exists("getDMPropertyLotSize")) {
    function getDMPropertyLotSize($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->LotSize != "") {
            return $single_property->LotSize;
        } else {
            return;
        }
    }
}
//END//RentableSf
if (!function_exists("getDMPropertyRentableSf")) {
    function getDMPropertyRentableSf($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Rentable_sf != "") {
            return $single_property->Rentable_sf;
        } else {
            return;
        }
    }
}
//END//PropertyId
if (!function_exists("getDMPropertyPropertyId")) {
    function getDMPropertyPropertyId($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->property_id != "") {
            return $single_property->property_id;
        } else {
            return;
        }
    }
}
//END//Latitude
if (!function_exists("getDMPropertyLatitude")) {
    function getDMPropertyLatitude($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Latitude != "") {
            return $single_property->Latitude;
        } else {
            return;
        }
    }
}
//END//Longitude
if (!function_exists("getDMPropertyLongitude")) {
    function getDMPropertyLongitude($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Longitude != "") {
            return $single_property->Longitude;
        } else {
            return;
        }
    }
}
//END//Address1
if (!function_exists("getDMPropertyAddress1")) {
    function getDMPropertyAddress1($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Address1 != "") {
            return $single_property->Address1;
        } else {
            return;
        }
    }
}
//END//Address2
if (!function_exists("getDMPropertyAddress2")) {
    function getDMPropertyAddress2($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Address2 != "") {
            return $single_property->Address2;
        } else {
            return;
        }
    }
}
//END//City
if (!function_exists("getDMPropertyCity")) {
    function getDMPropertyCity($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->City != "") {
            return $single_property->City;
        } else {
            return;
        }
    }
}
//END//State
if (!function_exists("getDMPropertyState")) {
    function getDMPropertyState($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->State != "") {
            return $single_property->State;
        } else {
            return;
        }
    }
}
//END//County
if (!function_exists("getDMPropertyCounty")) {
    function getDMPropertyCounty($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Country != "") {
            return $single_property->Country;
        } else {
            return;
        }
    }
}
//END//Zipcode
if (!function_exists("getDMPropertyZipcode")) {
    function getDMPropertyZipcode($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ZipCode != "") {
            return $single_property->ZipCode;
        } else {
            return;
        }
    }
}
//END//Stories
if (!function_exists("getDMPropertyStories")) {
    function getDMPropertyStories($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Stories != "") {
            return $single_property->Stories;
        } else {
            return;
        }
    }
}
//END//Apn
if (!function_exists("getDMPropertyApn")) {
    function getDMPropertyApn($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->APN != "") {
            return $single_property->APN;
        } else {
            return;
        }
    }
}
//END//ParkingRatio
if (!function_exists("getDMPropertyParkingRatio")) {
    function getDMPropertyParkingRatio($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ParkingRatio != "") {
            return $single_property->ParkingRatio;
        } else {
            return;
        }
    }
}
//END//Zoning
if (!function_exists("getDMPropertyZoning")) {
    function getDMPropertyZoning($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->zoning != "") {
            return $single_property->zoning;
        } else {
            return;
        }
    }
}

//ClientName
if (!function_exists("getDMPropertyClientName")) {
    function getDMPropertyClientName($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->contactname != "") {
            return $single_property->contactname;
        } else {
            return;
        }
    }
}
//END//Price
if (!function_exists("getDMPropertyPrice")) {
    function getDMPropertyPrice($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->price != "") {
            return $single_property->price;
        } else {
            return;
        }
    }
}
//END//PricePsf
if (!function_exists("getDMPropertyPricePsf")) {
    function getDMPropertyPricePsf($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PricePSF != "") {
            return '$'.number_format($single_property->PricePSF);
        } else {
            return;
        }
    }
}
//END//AskingPrice
if (!function_exists("getDMPropertyAskingPrice")) {
    function getDMPropertyAskingPrice($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->AskingPrice != "" && $single_property->AskingPrice != '0.00') {
            return  '$'.number_format($single_property->AskingPrice);
        } else {
            return 'Unpriced';
        }
    }
}
//END//T12Caprate
if (!function_exists("getDMPropertyT12Caprate")) {
    function getDMPropertyT12Caprate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->T12CapRate != "") {
            return '$'.number_format($single_property->t12_noi);
        } else {
            return;
        }
    }
}
//END
//InvestmentPeriod
if (!function_exists("getDMPropertyInvestmentPeriod")) {
    function getDMPropertyInvestmentPeriod($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->InvestmentPeriod != "") {
            return $single_property->InvestmentPeriod.' Years';
        } else {
            return;
        }
    }
}
//END//LeveredIrr
if (!function_exists("getDMPropertyLeveredIrr")) {
    function getDMPropertyLeveredIrr($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->LeveredIRR != "") {
            return $single_property->LeveredIRR.'%';
        } else {
            return;
        }
    }
}
//END//UnleveredIrr
if (!function_exists("getDMPropertyUnleveredIrr")) {
    function getDMPropertyUnleveredIrr($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->UnleveredIRR != "") {
            return $single_property->UnleveredIRR.'%';
        } else {
            return;
        }
    }
}
//END//ReturnOnCost
if (!function_exists("getDMPropertyReturnOnCost")) {
    function getDMPropertyReturnOnCost($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ReturnOnCost != "") {
            return '$'.number_format($single_property->ReturnOnCost);
        } else {
            return;
        }
    }
}
//END//Grm
if (!function_exists("getDMPropertyGrm")) {
    function getDMPropertyGrm($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->GRM != "") {
            return $single_property->GRM;
        } else {
            return;
        }
    }
}
//END//PotentialGrm
if (!function_exists("getDMPropertyPotentialGrm")) {
    function getDMPropertyPotentialGrm($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PotentialGRM != "") {
            return $single_property->PotentialGRM;
        } else {
            return;
        }
    }
}
//END//InPlaceCapRate
if (!function_exists("getDMPropertyInPlaceCapRate")) {
    function getDMPropertyInPlaceCapRate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->InPlaceCapRate != "") {
            return $single_property->InPlaceCapRate.'%';
        } else {
            return;
        }
    }
}
//END//InPlaceNoi
if (!function_exists("getDMPropertyInPlaceNoi")) {
    function getDMPropertyInPlaceNoi($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->InPlaceNOI != "") {
            return '$'.number_format($single_property->InPlaceNOI);
        } else {
            return;
        }
    }
}
//END//Year1CapRate
if (!function_exists("getDMPropertyYear1CapRate")) {
    function getDMPropertyYear1CapRate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Year1CapRate != "") {
            return $single_property->Year1CapRate.'%';
        } else {
            return;
        }
    }
}
//END//MarkToMarketCapRate
if (!function_exists("getDMPropertyMarkToMarketCapRate")) {
    function getDMPropertyMarkToMarketCapRate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->MarkToMarketCapRate != "") {
            return $single_property->MarkToMarketCapRate.'%';
        } else {
            return;
        }
    }
}
//END//InPlaceRents
if (!function_exists("getDMPropertyInPlaceRents")) {
    function getDMPropertyInPlaceRents($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->InPlaceRents != "") {
            return $single_property->InPlaceRents;
        } else {
            return;
        }
    }
}
//END//MarketRents
if (!function_exists("getDMPropertyMarketRents")) {
    function getDMPropertyMarketRents($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->MarketRents != "") {
            return $single_property->MarketRents;
        } else {
            return;
        }
    }
}
//END//Walt
if (!function_exists("getDMPropertyWalt")) {
    function getDMPropertyWalt($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Walt != "") {
            return floatval($single_property->Walt).' Years';
        } else {
            return;
        }
    }
}
//END//AvgInplaceRentsBelowMarket
if (!function_exists("getDMPropertyAvgInplaceRentsBelowMarket")) {
    function getDMPropertyAvgInplaceRentsBelowMarket($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->AvgInPlaceRentsBelowMarket != "") {
            return $single_property->AvgInPlaceRentsBelowMarket.'%';
        } else {
            return;
        }
    }
}
//END//YrIrr10
if (!function_exists("getDMPropertyYrIrr10")) {
    function getDMPropertyYrIrr10($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->YrlRR10 != "") {
            return $single_property->YrlRR10;
        } else {
            return;
        }
    }
}
//END//Yr10EquityMultiple
if (!function_exists("getDMPropertyYr10EquityMultiple")) {
    function getDMPropertyYr10EquityMultiple($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Yr10EquityMultiple != "") {
            return $single_property->Yr10EquityMultiple;
        } else {
            return;
        }
    }
}
//END//Tenancy
if (!function_exists("getDMPropertyTenancy")) {
    function getDMPropertyTenancy($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Tenancy != "") {
            return $single_property->Tenancy;
        } else {
            return;
        }
    }
}
//END//NumberOfTenants
if (!function_exists("getDMPropertyNumberOfTenants")) {
    function getDMPropertyNumberOfTenants($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->NumberOfTenants != "") {
            return $single_property->NumberOfTenants;
        } else {
            return;
        }
    }
}
//END//Units
if (!function_exists("getDMPropertyUnits")) {
    function getDMPropertyUnits($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Units != "") {
            return $single_property->Units;
        } else {
            return;
        }
    }
}
//END//YearRenovated
if (!function_exists("getDMPropertyYearRenovated")) {
    function getDMPropertyYearRenovated($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->YearRenovated != "") {
            return $single_property->YearRenovated;
        } else {
            return;
        }
    }
}
//END//FeaturedImage
if (!function_exists("getDMPropertyFeaturedImage")) {
    function getDMPropertyFeaturedImage($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->FeaturedImage != "") {
            return $single_property->FeaturedImage;
        } else {
            return;
        }
    }
}
//END//PropertyContent
if (!function_exists("getDMPropertyPropertyContent")) {
    function getDMPropertyPropertyContent($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PropertyContent != "") {
			return htmlspecialchars_decode(stripslashes($single_property->PropertyContent));
        } else {
            return;
        }
    }
}
//END//AgentsList
if (!function_exists("getDMPropertyAgentsList")) {
    function getDMPropertyAgentsList($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PropertyAgents != "") {
            return $single_property->PropertyAgents;
        } else {
            return;
        }
    }
}
//END//UrlSlug
if (!function_exists("getDMPropertyUrlSlug")) {
    function getDMPropertyUrlSlug($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->url_slug != "") {
            return $single_property->url_slug;
        } else {
            return;
        }
    }
}
//END//OeplTitle
if (!function_exists("getDMPropertyOeplTitle")) {
    function getDMPropertyOeplTitle($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->oepl_title != "") {
            return $single_property->oepl_title;
        } else {
            return;
        }
    }
}
//END//MetaDescription
if (!function_exists("getDMPropertyMetaDescription")) {
    function getDMPropertyMetaDescription($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->MetaDescription != "") {
            return $single_property->MetaDescription;
        } else {
            return;
        }
    }
}
//END//OeplKeyword
if (!function_exists("getDMPropertyOeplKeyword")) {
    function getDMPropertyOeplKeyword($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->oepl_keyword != "") {
            return $single_property->oepl_keyword;
        } else {
            return;
        }
    }
}
//END//CashOnCash
if (!function_exists("getDMPropertyCashOnCash")) {
    function getDMPropertyCashOnCash($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CashOnCash != "") {
            return $single_property->CashOnCash;
        } else {
            return;
        }
    }
}
//END//Year1Noi
if (!function_exists("getDMPropertyYear1Noi")) {
    function getDMPropertyYear1Noi($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->Year1NOI != "") {
            return '$'.number_format($single_property->Year1NOI);
        } else {
            return;
        }
    }
}
//END//T12Noi
if (!function_exists("getDMPropertyT12Noi")) {
    function getDMPropertyT12Noi($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->T12NOI != "") {
            return $single_property->T12NOI;
        } else {
            return;
        }
    }
}
//END//FeaturedHome
if (!function_exists("getDMPropertyFeaturedHome")) {
    function getDMPropertyFeaturedHome($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->FeaturedHome != "") {
            return $single_property->FeaturedHome;
        } else {
            return;
        }
    }
}
//END//PrivateList
if (!function_exists("getDMPropertyPrivateList")) {
    function getDMPropertyPrivateList($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PrivateList != "") {
            return $single_property->PrivateList;
        } else {
            return;
        }
    }
}
//END//DisplayOrder
if (!function_exists("getDMPropertyDisplayOrder")) {
    function getDMPropertyDisplayOrder($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->DisplayOrder != "") {
            return $single_property->DisplayOrder;
        } else {
            return;
        }
    }
}
//END//PrivateUrl
if (!function_exists("getDMPropertyPrivateUrl")) {
    function getDMPropertyPrivateUrl($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PrivateURL != "") {
            return $single_property->PrivateURL;
        } else {
            return;
        }
    }
}
//END//CaContent
if (!function_exists("getDMPropertyCaContent")) {
    function getDMPropertyCaContent($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CAContent != "") {
            return $single_property->CAContent;
        } else {
            return;
        }
    }
}
//END//CaDocument
if (!function_exists("getDMPropertyCaDocument")) {
    function getDMPropertyCaDocument($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CADocument != "") {
            return $single_property->CADocument;
        } else {
            return;
        }
    }
}
//END//MainVideo
if (!function_exists("getDMPropertyMainVideo")) {
    function getDMPropertyMainVideo($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->MainVideo != "") {
            return $single_property->MainVideo;
        } else {
            return;
        }
    }
}
//END//PropertyImages
if (!function_exists("getDMPropertyPropertyImages")) {
    function getDMPropertyPropertyImages($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->property_images != "") {
            return $single_property->property_images;
        } else {
            return;
        }
    }
}
//END//CdDescription
if (!function_exists("getDMPropertyCdDescription")) {
    function getDMPropertyCdDescription($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CDDescription != "") {
            return $single_property->CDDescription;
        } else {
            return;
        }
    }
}
//END//SalesPrice
if (!function_exists("getDMPropertySalesPrice")) {
    function getDMPropertySalesPrice($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->SalesPrice != "") {
            return $single_property->SalesPrice;
        } else {
            return;
        }
    }
}
//END//DocID
if (!function_exists("getDMPropertyDocID")) {
    function getDMPropertyDocID($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->DocID != "") {
            return $single_property->DocID;
        } else {
            return;
        }
    }
}
//END
//SaveStatus
if (!function_exists("getDMPropertySaveStatus")) {
    function getDMPropertySaveStatus($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->SaveStatusID != "") {
            return $single_property->SaveStatusID;
        } else {
            return;
        }
    }
}
//END//Seller
if (!function_exists("getDMPropertySeller")) {
    function getDMPropertySeller($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->seller != "") {
            return $single_property->seller;
        } else {
            return;
        }
    }
}
//END//ListingExpiration
if (!function_exists("getDMPropertyListingExpiration")) {
    function getDMPropertyListingExpiration($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ListingExpiration != "") {
            return $single_property->ListingExpiration;
        } else {
            return;
        }
    }
}
//END//SalePricePsf
if (!function_exists("getDMPropertySalePricePsf")) {
    function getDMPropertySalePricePsf($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->SalesPricePSF != "") {
            return $single_property->SalesPricePSF;
        } else {
            return;
        }
    }
}
//END//ClosingCapRate
if (!function_exists("getDMPropertyClosingCapRate")) {
    function getDMPropertyClosingCapRate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ClosingCapRate != "") {
            return $single_property->ClosingCapRate;
        } else {
            return;
        }
    }
}
//END//Buyer
if (!function_exists("getDMPropertyBuyer")) {
    function getDMPropertyBuyer($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->buyer != "") {
            return $single_property->buyer;
        } else {
            return;
        }
    }
}
//END//FeaturedClosedDeal
if (!function_exists("getDMPropertyFeaturedClosedDeal")) {
    function getDMPropertyFeaturedClosedDeal($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->FeaturedCloseDeal != "") {
            return $single_property->FeaturedCloseDeal;
        } else {
            return;
        }
    }
}
//END//FeaturedClosedDealOrder
if (!function_exists("getDMPropertyFeaturedClosedDealOrder")) {
    function getDMPropertyFeaturedClosedDealOrder($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->FeaturedCloseDealOrder != "") {
            return $single_property->FeaturedCloseDealOrder;
        } else {
            return;
        }
    }
}
//END//DaysOnMarket
if (!function_exists("getDMPropertyDaysOnMarket")) {
    function getDMPropertyDaysOnMarket($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->DaysOnMarket != "") {
            return $single_property->DaysOnMarket;
        } else {
            return;
        }
    }
}
//END//NoOfOffers
if (!function_exists("getDMPropertyNoOfOffers")) {
    function getDMPropertyNoOfOffers($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->NoOfOffers != "") {
            return $single_property->NoOfOffers;
        } else {
            return;
        }
    }
}
//END//CloseDate
if (!function_exists("getDMPropertyCloseDate")) {
    function getDMPropertyCloseDate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CloseDate != "") {
            return $single_property->CloseDate;
        } else {
            return;
        }
    }
}
//END//CloseSeller
if (!function_exists("getDMPropertyCloseSeller")) {
    function getDMPropertyCloseSeller($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->close_seller != "") {
            return $single_property->close_seller;
        } else {
            return;
        }
    }
}
//END//PropertyTypeDrop
if (!function_exists("getDMPropertyPropertyTypeDrop")) {
    function getDMPropertyPropertyTypeDrop($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->property_type_drop != "") {
            return $single_property->property_type_drop;
        } else {
            return;
        }
    }
}
//END//Markets
if (!function_exists("getDMPropertyMarkets")) {
    function getDMPropertyMarkets($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->markets != "") {
            return $single_property->markets;
        } else {
            return;
        }
    }
}
//END//RiskSpectrum
if (!function_exists("getDMPropertyRiskSpectrum")) {
    function getDMPropertyRiskSpectrum($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->RiskSpectrum != "") {
            return $single_property->RiskSpectrum;
        } else {
            return;
        }
    }
}
//END//RtrnMatric
if (!function_exists("getDMPropertyRtrnMatric")) {
    function getDMPropertyRtrnMatric($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ReturnMatric != "") {
            return $single_property->ReturnMatric;
        } else {
            return;
        }
    }
}
//END//DealSize
if (!function_exists("getDMPropertyDealSize")) {
    function getDMPropertyDealSize($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->DealSize != "") {
            return $single_property->DealSize;
        } else {
            return;
        }
    }
}
//END//EstimatedCommission
if (!function_exists("getDMPropertyEstimatedCommission")) {
    function getDMPropertyEstimatedCommission($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->EstimatedCommission != "") {
            return $single_property->EstimatedCommission;
        } else {
            return;
        }
    }
}
//END//BuildingClass
if (!function_exists("getDMPropertyBuildingClass")) {
    function getDMPropertyBuildingClass($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->BuildingClassID != "") {
            return $single_property->BuildingClassID;
        } else {
            return;
        }
    }
}
//END//CommissionEarned
if (!function_exists("getDMPropertyCommissionEarned")) {
    function getDMPropertyCommissionEarned($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CommissionEarned != "") {
            return $single_property->CommissionEarned;
        } else {
            return;
        }
    }
}
//END//SpVsAp
if (!function_exists("getDMPropertySpVsAp")) {
    function getDMPropertySpVsAp($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->SPvsAP != "") {
            return $single_property->SPvsAP;
        } else {
            return;
        }
    }
}
//END//InternalSaleNotes
if (!function_exists("getDMPropertyInternalSaleNotes")) {
    function getDMPropertyInternalSaleNotes($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->InternalSalesNotes != "") {
            return $single_property->InternalSalesNotes;
        } else {
            return;
        }
    }
}
//END//IsSaleprice
if (!function_exists("getDMPropertyIsSaleprice")) {
    function getDMPropertyIsSaleprice($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsSalePrice != "") {
            return $single_property->IsSalePrice;
        } else {
            return;
        }
    }
}
//END//IsSalepricepsf
if (!function_exists("getDMPropertyIsSalepricepsf")) {
    function getDMPropertyIsSalepricepsf($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsSalesPricePSF != "") {
            return $single_property->IsSalesPricePSF;
        } else {
            return;
        }
    }
}
//END//IsClosecaprate
if (!function_exists("getDMPropertyIsClosecaprate")) {
    function getDMPropertyIsClosecaprate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsCloseCAPRate != "") {
            return $single_property->IsCloseCAPRate;
        } else {
            return;
        }
    }
}
//END//IsBuyer
if (!function_exists("getDMPropertyIsBuyer")) {
    function getDMPropertyIsBuyer($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsBuyer != "") {
            return $single_property->IsBuyer;
        } else {
            return;
        }
    }
}
//END//IsSeller
if (!function_exists("getDMPropertyIsSeller")) {
    function getDMPropertyIsSeller($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsSeller != "") {
            return $single_property->IsSeller;
        } else {
            return;
        }
    }
}
//END//IsCosingdate
if (!function_exists("getDMPropertyIsCosingdate")) {
    function getDMPropertyIsCosingdate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsClosingDate != "") {
            return $single_property->IsClosingDate;
        } else {
            return;
        }
    }
}
//END//IsUnpriced
if (!function_exists("getDMPropertyIsUnpriced")) {
    function getDMPropertyIsUnpriced($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_unpriced != "") {
            return $single_property->is_unpriced;
        } else {
            return;
        }
    }
}
//END//IsDaysOnMarket
if (!function_exists("getDMPropertyIsDaysOnMarket")) {
    function getDMPropertyIsDaysOnMarket($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_days_on_market != "") {
            return $single_property->is_days_on_market;
        } else {
            return;
        }
    }
}
//END//IsSpVsAp
if (!function_exists("getDMPropertyIsSpVsAp")) {
    function getDMPropertyIsSpVsAp($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_sp_vs_ap != "") {
            return $single_property->is_sp_vs_ap;
        } else {
            return;
        }
    }
}
//END//IsPageView
if (!function_exists("getDMPropertyIsPageView")) {
    function getDMPropertyIsPageView($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_page_view != "") {
            return $single_property->is_page_view;
        } else {
            return;
        }
    }
}
//END//IsOfferRecieved
if (!function_exists("getDMPropertyIsOfferRecieved")) {
    function getDMPropertyIsOfferRecieved($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_offer_recieved != "") {
            return $single_property->is_offer_recieved;
        } else {
            return;
        }
    }
}
//END//IsExecuredCa
if (!function_exists("getDMPropertyIsExecuredCa")) {
    function getDMPropertyIsExecuredCa($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_execured_ca != "") {
            return $single_property->is_execured_ca;
        } else {
            return;
        }
    }
}
//END//IsOmDownload
if (!function_exists("getDMPropertyIsOmDownload")) {
    function getDMPropertyIsOmDownload($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_om_download != "") {
            return $single_property->is_om_download;
        } else {
            return;
        }
    }
}
//END//BannerImage
if (!function_exists("getDMPropertyBannerImage")) {
    function getDMPropertyBannerImage($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->BannerImage != "") {
            return $single_property->BannerImage;
        } else {
            return;
        }
    }
}
//END//CgData
if (!function_exists("getDMPropertyCgData")) {
    function getDMPropertyCgData($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->cg_data != "") {
            return $single_property->cg_data;
        } else {
            return;
        }
    }
}
//END//TrueBuyer
if (!function_exists("getDMPropertyTrueBuyer")) {
    function getDMPropertyTrueBuyer($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->true_buyer != "") {
            return $single_property->true_buyer;
        } else {
            return;
        }
    }
}
//END//IsTrueBuyer
if (!function_exists("getDMPropertyIsTrueBuyer")) {
    function getDMPropertyIsTrueBuyer($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_true_buyer != "") {
            return $single_property->is_true_buyer;
        } else {
            return;
        }
    }
}
//END//CapitalInvested
if (!function_exists("getDMPropertyCapitalInvested")) {
    function getDMPropertyCapitalInvested($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CapitalInvested != "") {
            return $single_property->CapitalInvested;
        } else {
            return;
        }
    }
}
//END//LastTransfer
if (!function_exists("getDMPropertyLastTransfer")) {
    function getDMPropertyLastTransfer($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->LastTransfer != "") {
            return $single_property->LastTransfer;
        } else {
            return;
        }
    }
}
//END//LastTransferPrice
if (!function_exists("getDMPropertyLastTransferPrice")) {
    function getDMPropertyLastTransferPrice($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->LastTransferPrice != "") {
            return $single_property->LastTransferPrice;
        } else {
            return;
        }
    }
}
//END//PricingExpectation
if (!function_exists("getDMPropertyPricingExpectation")) {
    function getDMPropertyPricingExpectation($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PricingExpectation != "") {
            return $single_property->PricingExpectation;
        } else {
            return;
        }
    }
}
//END//SellerMotivation
if (!function_exists("getDMPropertySellerMotivation")) {
    function getDMPropertySellerMotivation($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->SellerMotivation != "") {
            return $single_property->SellerMotivation;
        } else {
            return;
        }
    }
}
//END//IsConfidential
if (!function_exists("getDMPropertyIsConfidential")) {
    function getDMPropertyIsConfidential($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_confidential != "") {
            return $single_property->is_confidential;
        } else {
            return;
        }
    }
}
//END//ReportDate
if (!function_exists("getDMPropertyReportDate")) {
    function getDMPropertyReportDate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->reportDate != "") {
            return $single_property->reportDate;
        } else {
            return;
        }
    }
}
//END//SalePriceUnit
if (!function_exists("getDMPropertySalePriceUnit")) {
    function getDMPropertySalePriceUnit($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->sale_price_unit != "") {
            return $single_property->sale_price_unit;
        } else {
            return;
        }
    }
}
//END//IsSaleDescription
if (!function_exists("getDMPropertyIsSaleDescription")) {
    function getDMPropertyIsSaleDescription($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_sale_description != "") {
            return $single_property->is_sale_description;
        } else {
            return;
        }
    }
}
//END//IsSalePriceUnit
if (!function_exists("getDMPropertyIsSalePriceUnit")) {
    function getDMPropertyIsSalePriceUnit($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_sale_price_unit != "") {
            return $single_property->is_sale_price_unit;
        } else {
            return;
        }
    }
}
//END//IsDelete
if (!function_exists("getDMPropertyIsDelete")) {
    function getDMPropertyIsDelete($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_delete != "") {
            return $single_property->is_delete;
        } else {
            return;
        }
    }
}
//END//DeletedDate
if (!function_exists("getDMPropertyDeletedDate")) {
    function getDMPropertyDeletedDate($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->deleted_date != "") {
            return $single_property->deleted_date;
        } else {
            return;
        }
    }
}
//END//UploadedCaFilename
if (!function_exists("getDMPropertyUploadedCaFilename")) {
    function getDMPropertyUploadedCaFilename($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->CAPdfDocument != "") {
            return $single_property->CAPdfDocument;
        } else {
            return;
        }
    }
}
//END//IsCaUploaded
if (!function_exists("getDMPropertyIsCaUploaded")) {
    function getDMPropertyIsCaUploaded($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->is_ca_uploaded != "") {
            return $single_property->is_ca_uploaded;
        } else {
            return;
        }
    }
}
//END//IsPressReleaseFile
if (!function_exists("getDMPropertyIsPressReleaseFile")) {
    function getDMPropertyIsPressReleaseFile($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->IsPressReleaseFile != "") {
            return $single_property->IsPressReleaseFile;
        } else {
            return;
        }
    }
}
//END//PressReleaseFilepath
if (!function_exists("getDMPropertyPressReleaseFilepath")) {
    function getDMPropertyPressReleaseFilepath($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PressReleaseFile != "") {
            return $single_property->PressReleaseFile;
        } else {
            return;
        }
    }
}
//END//PressReleaseLink
if (!function_exists("getDMPropertyPressReleaseLink")) {
    function getDMPropertyPressReleaseLink($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->PressReleaseLink != "") {
            return $single_property->PressReleaseLink;
        } else {
            return;
        }
    }
}
//END//Iscadocupload
if (!function_exists("getDMPropertyIscadocupload")) {
    function getDMPropertyIscadocupload($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->iscadocupload != "") {
            return $single_property->iscadocupload;
        } else {
            return;
        }
    }
}
//END//Originalcafile
if (!function_exists("getDMPropertyOriginalcafile")) {
    function getDMPropertyOriginalcafile($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->originalcafile != "") {
            return $single_property->originalcafile;
        } else {
            return;
        }
    }
}
//END//ImageAltText
if (!function_exists("getDMPropertyImageAltText")) {
    function getDMPropertyImageAltText($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->ImageAltText != "") {
            return $single_property->ImageAltText;
        } else {
            return;
        }
    }
}
//END//PressReleaseOriginalFileName
if (!function_exists("getDMPropertyPressReleaseOriginalFileName")) {
    function getDMPropertyPressReleaseOriginalFileName($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->press_release_original_file_name != "") {
            return $single_property->press_release_original_file_name;
        } else {
            return;
        }
    }
}

if (!function_exists("getDMProperyURL")) {
    function getDMProperyURL($args = array())
    {
        $post_name  = get_option('datum_property_listing_id');
        $dm_post    = get_post($post_name);
        global $single_property;
        if (isset($single_property) && $single_property->ID != "") {
            return home_url($dm_post->post_name).'/'.$single_property->ID;
        } else {
            return;
        }
    }
}

if (!function_exists("getDMProperyMainURL")) {
    function getDMProperyMainURL($args = array())
    {
        $post_name  = get_option('datum_property_listing_id');
        $dm_post    = get_post($post_name);
        global $single_property;
        if (isset($single_property) && $single_property->ID != "") {
            return home_url($dm_post->post_name);
        } else {
            return;
        }
    }
}

if (!function_exists("getDMOtherImage")) {
    function getDMOtherImage($args = array())
    {
        global $single_property;
        if (isset($single_property) && $single_property->OtherImage != "") {
            return $single_property->OtherImage;
        } else {
            return;
        }
    }
}
if (!function_exists("getDefultImage")) {
    function getDefultImage($args = array())
    {
        return;
    }
}
if (!function_exists("getDMPropertyMarkerListImage")) {
    function getDMPropertyMarkerListImage($args = array())
    {
        if(getDMPropertyFeaturedImage() != ''){
            return getDMPropertyFeaturedImage();
        }else if(!empty(getDMOtherImage())){
            $getDMOtherImage = getDMOtherImage();
            return $getDMOtherImage[0];
        }else{
            return getDefultImage();
        }
    }
}
if (!function_exists("getDMpropertyHighlights")) {
    function getDMpropertyHighlights($args = array())
    {
        global $single_property;
        if(empty($single_property->propertyHighlights)){
            return;
        }else{
            return $single_property->propertyHighlights;
        }
    }
}
//END

?>
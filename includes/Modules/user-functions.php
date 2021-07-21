<?php
/**
 * ID
 */
if (!function_exists("getDMUserId")) {
    function getDMUserId($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->Id != "") {
            return $datum_user->Id;
        } else {
            return;
        }
    }
}

/**
 * ENDgetDMUserFirstName
 * BoxFolder
 */
if (!function_exists("getDMUserFirstName")) {
    function getDMUserFirstName($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->FirstName != "") {
            return $datum_user->FirstName;
        } else {
            return;
        }
    }
}

/**
 * END
 * LastName
 */
if (!function_exists("getDMUserLastName")) {
    function getDMUserLastName($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->LastName != "") {
            return $datum_user->LastName;
        } else {
            return;
        }
    }
}

/**
 * END
 * Email
 */
if (!function_exists("getDMUserEmail")) {
    function getDMUserEmail($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->Email != "") {
            return $datum_user->Email;
        } else {
            return;
        }
    }
}

/**
 * END
 * ProfileImage
 */
if (!function_exists("getDMUserProfileImage")) {
    function getDMUserProfileImage($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->ProfileImage != "") {
            return $datum_user->ProfileImage;
        } else {
            return;
        }
    }
}
/**
 * END
 * Title
 */
if (!function_exists("getDMUserTitle")) {
    function getDMUserTitle($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->Title != "") {
            return $datum_user->Title;
        } else {
            return;
        }
    }
}

/**
 * END
 * CompanyId
 */
if (!function_exists("getDMUserCompanyId")) {
    function getDMUserCompanyId($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->CompanyId != "") {
            return $datum_user->CompanyId;
        } else {
            return;
        }
    }
}

/**
 * END
 * IndustryRole
 */
if (!function_exists("getDMUserIndustryRole")) {
    function getDMUserIndustryRole($args = '')
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->IndustryRole != "") {
            if($datum_user->IndustryRole == $args){
                return 'checked';
            }
        } else {
            return;
        }
    }
}

/**
 * END
 * InvestorTypeId
 */
if (!function_exists("getDMUserInvestorTypeId")) {
    function getDMUserInvestorTypeId($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->InvestorTypeId != "") {
            if($datum_user->InvestorTypeId == $args){
                return 'checked';
            }
        } else {
            return;
        }
    }
}
/**
 * END
 * BrokerTypeId
 */
if (!function_exists("getDMUserBrokerTypeId")) {
    function getDMUserBrokerTypeId($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->BrokerTypeId != "") {
            if($datum_user->BrokerTypeId == $args){
                return 'checked';
            }
        } else {
            return;
        }
    }
}
/**
 * END
 * WorkPhone
 */
if (!function_exists("getDMUserWorkPhone")) {
    function getDMUserWorkPhone($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->WorkPhone != "") {
            return $datum_user->get_user_address_details_relation->WorkPhone;
        } else {
            return;
        }
    }
}
/**
 * END
 * MobilePhone
 */
if (!function_exists("getDMUserMobilePhone")) {
    function getDMUserMobilePhone($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->MobilePhone != "") {
            return $datum_user->get_user_address_details_relation->MobilePhone;
        } else {
            return;
        }
    }
}

/**
 * END
 * ZipCode
 */
if (!function_exists("getDMUserZipCode")) {
    function getDMUserZipCode($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->ZipCode != "") {
            return $datum_user->get_user_address_details_relation->ZipCode;
        } else {
            return;
        }
    }
}

/**
 * END
 * City
 */
if (!function_exists("getDMUserCity")) {
    function getDMUserCity($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->City != "") {
            return $datum_user->get_user_address_details_relation->City;
        } else {
            return;
        }
    }
}

/**
 * END
 * Country
 */
if (!function_exists("getDMUserCountry")) {
    function getDMUserCountry($args = '',$key = '')
    {
        global $datum_user;
        if (isset($datum_user) && !empty($datum_user) && $datum_user->get_user_address_details_relation->Country != "") {
            if($args == $datum_user->get_user_address_details_relation->Country){
                return 'selected';
            }
        } else {
            if($args == 'US'){
                return 'selected';
            }else{
                return;
            }
        }
    }
}

/**
 * END
 * City
 */
if (!function_exists("getDMUserSuite")) {
    function getDMUserSuite($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->Suite != "") {
            return $datum_user->get_user_address_details_relation->Suite;
        } else {
            return;
        }
    }
}

if (!function_exists("getDMUserCompanyName")) {
    function getDMUserCompanyName($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->CompanyName != "") {
            return $datum_user->CompanyName;
        } else {
            return;
        }
    }
}

/**
 * END
 * Street
 */
if (!function_exists("getDMUserStreet")) {
    function getDMUserStreet($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->Street != "") {
            return $datum_user->get_user_address_details_relation->Street;
        } else {
            return;
        }
    }
}

/**
 * END
 * Street
 */
if (!function_exists("getDMUserState")) {
    function getDMUserState($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->State != "") {
            return $datum_user->get_user_address_details_relation->State;
        } else {
            return;
        }
    }
}

/**
 * END
 * ZipCode
 */
if (!function_exists("getDMUserZipCode")) {
    function getDMUserZipCode($args = array())
    {
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_user_address_details_relation->ZipCode != "") {
            return $datum_user->get_user_address_details_relation->ZipCode;
        } else {
            return;
        }
    }
}

/**
 * Get current user exchange status ID
 * @returns INT
 */
if (!function_exists("getDMUserExchangeStatusId")) {
    function getDMUserExchangeStatusId($args = array()){
        global $datum_user;
        if (isset($datum_user) && $datum_user->ExchangeStatusId != "") {
            return $datum_user->ExchangeStatusId;
        } else {
            return;
        }
    }
}

/**
 * Get current user AcquisitionCriteriaSubType IDS
 * @returns JSON
 */
if (!function_exists("getDMUserAcquisitionCriteriaSubType")) {
    function getDMUserAcquisitionCriteriaSubType($args = array()){
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_acquisitioncriteria_contact_relation->acquisitionCriteriaSubType != "") {
            return $datum_user->get_acquisitioncriteria_contact_relation->acquisitionCriteriaSubType;
        } else {
            return;
        }
    }
}

/**
 * Get current user AcquisitionCriteriaType IDS
 * @returns JSON
 */
if (!function_exists("getDMUserAcquisitionCriteriaType")) {
    function getDMUserAcquisitionCriteriaType($args = array()){
        global $datum_user;
        if (isset($datum_user) && $datum_user->get_acquisitioncriteria_contact_relation->acquisitionCriteriaType != "") {
            return $datum_user->get_acquisitioncriteria_contact_relation->acquisitionCriteriaType;
        } else {
            return;
        }
    }
}
/**
 * END
 * ZipCode
 */
if (!function_exists("companyList")) {
    function companyList($args = array())
    {
        global $criteria;   
        if (isset($criteria) &&  !empty($criteria->data->company)) {
            return $criteria->data->company;
        } else {
            return;
        }
    }
}

/**
 * END
 * ZipCode
 */
if (!function_exists("industryRole")) {
    function industryRole($args = array())
    {
        global $criteria;
        if (isset($criteria) &&  !empty($criteria->data->IndustryRole)) {
            return $criteria->data->IndustryRole;
        } else {
            return;
        }
    }
}

/**
 * END
 * industryType
 */
if (!function_exists("brokerType")) {
    function brokerType($args = array())
    {
        global $criteria;
        if (isset($criteria) &&  !empty($criteria->data->BrokerType)) {
            return $criteria->data->BrokerType;
        } else {
            return;
        }
    }
}

/**
 * END
 * industryType
 */
if (!function_exists("industryType")) {
    function industryType($args = array())
    {
        global $criteria;
        if (isset($criteria) &&  !empty($criteria->data->InvestorType)) {
            return $criteria->data->InvestorType;
        } else {
            return;
        }
    }
}
if( ! function_exists('state_name') ) {

    function state_name(){
        global $criteria;
        if (isset($criteria) &&  !empty($criteria->data->State)) {
            return $criteria->data->State;
        } else {
            return;
        }
    }
}
if( ! function_exists('counry_name') ) {

    function counry_name(){
        global $criteria;
        if (isset($criteria) &&  !empty($criteria->data->Country)) {
            return $criteria->data->Country;
        } else {
            return;
        }
    }
}
?>
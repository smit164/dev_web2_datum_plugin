<?php
/**
 * Briskstar DM_AJAX. AJAX Event Handlers.
 *
 * @class   DM_AJAX
 * @package Briskstar/Classes
 */

defined( 'ABSPATH' ) || exit;


/**
 * DM_Ajax class.
 */
class Signup {

	const DEFAULT_VALIDATION_MSG 	= "Please fill the required field.";
	/**
	 * Hook in ajax handlers.
	 */
	public function __construct() {

		//add_filter( 'datum_login_pages_step', array( $this, 'login_pages_step' ), 20 );
	}

	public static function init() {

	}

	public function login_pages_step_one($value='')
	{
		return
		array(
			array(
				'type' => 'section100',
				'id'   => '',
			),
				array(
					'type' => 'section66',
					'id'   => 'account_endpoint_options',
				),
					array(
						'title'    => __( 'First name<span>*</span>', 'datum' ),
						'id'       => '',
						'type'     => 'text',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'name'	   => 'first_name',
						'get_name' => 'getDMUserFirstName',
						'disabled' => '',
					),
					array(
						'title'    => __( 'Last name<span>*</span>', 'datum' ),
						'id'       => '',
						'type'     => 'text',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'disabled' => '',
						'get_name' => 'getDMUserLastName',
						'name'	   => 'last_name'
					),
					array(
						'title'    => __( 'Title', 'datum' ),
						'id'       => '',
						'type'     => 'text',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'disabled' => '',
						'get_name' => 'getDMUserTitle',
						'name'	   => 'title'
					),
					array(
						'title'    => __( 'Company', 'datum' ),
						'id'       => '',
						'type'     => 'select',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'disabled' => '',
						'function' => 'companyList',
						'get_name' => 'getDMUserCompanyId',
						'name'	   => 'company'
					),
				array(
					'type' => 'sectionend',
					'id'   => 'account_endpoint_options',
				),
				array(
					'type' => 'section33',
					'id'   => '',
				),
						array(
							'title'    => __( 'Upload Photo', 'datum' ),
							'id'       => '',
							'type'     => 'file',
							'default'  => '',
							'class'    => '',
							'css'      => '',
							'disabled' => '',
							'get_name' => 'getDMUserProfileImage',
							'name'	   => 'avatar',
                            'register' => 'yes'
						),
				array(
					'type' => 'sectionend',
					'id'   => 'account_endpoint_options',
				),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section100',
				'id'   => '',
			),
			array(
				'title'    => __( 'Street<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserStreet',
				'name'	   => 'street'
			),
			array(
				'title'    => __( 'Suite', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserSuite',
				'name'	   => 'suite'
			),
			array(
				'title'    => __( 'City<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserCity',
				'name'	   => 'city'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section100',
				'id'   => '',
			),
			array(
				'title'    => __( 'State<span>*</span>', 'datum' ),
				'id'       => 'street_text_box',
				'type'     => 'text',
				'default'  => '',
				'class'    => 'hide_S state_text_id',
				'css'      => '',
				'disabled' => '',
				'get_name' => '',
				'name'	   => 'state_text'
			),
			array(
				'title'    => __( 'State<span>*</span>', 'datum' ),
				'id'       => 'state_lead',
				'type'     => 'select',
				'default'  => '',
				'class'    => 'state_text_select',
				'css'      => '',
				'name'	   => 'state_select',
				'disabled' => '',
				'get_name' => '',
				'function' => 'state_name',
			),
			array(
				'title'    => __( 'Country<span>*</span>', 'datum' ),
				'id'       => 'country_lead',
				'type'     => 'select',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserCountry',
				'name'	   => 'country',
				'function' => 'counry_name',
				'selected' => 'US',
			),
			array(
				'title'    => __( 'Zip Code<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'ZipCode',
				'name'	   => 'zipcode'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section66',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Work Phone<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'input_class'    => 'phone_number',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserWorkPhone',
				'name'	   => 'cell_phone'
			),
			array(
				'title'    => __( 'Mobile Phone', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'input_class'    => 'phone_number',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserMobilePhone',
				'name'	   => 'mobile_phone'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section66',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Email Address<span>*</span>', 'datum' ),
				'id'       => 'email',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserEmail',
				'name'	   => 'email'
			),
			array(
				'title'    => __( 'Reenter Email Address<span>*</span>', 'datum' ),
				'id'       => 'reenter_email_address',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserEmail',
				'name'	   => 'reenter_email_address'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section66',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Password<span>*</span>', 'datum' ),
				'id'       => 'password',
				'type'     => 'password',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => '',
				'name'	   => 'password'
			),
			array(
				'title'    => __( 'Confirm Password<span>*</span>', 'datum' ),
				'id'       => 'confirm_password',
				'type'     => 'password',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'get_name' => '',
				'disabled' => '',
				'name'	   => 'confirm_password'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionstart',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Industry Role<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'css'      => '',
				'disabled' => '',
				'name'	   => 'i_am',
				'get_name' => 'getDMUserIndustryRole',
				'function' => 'industryRole',
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionstart',
				'id'   => 'oepl_investor',
			),
			array(
				'title'    => __( 'Investor Type:', 'datum' ),
				'id'       => 'oepl_investor',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'function' => 'industryType',
				'css'      => '',
				'get_name' => 'getDMUserInvestorTypeId',
				'name'	   => 'investor_type',
				'option'   => array(
					'investor_type' => array(
						'Private' 		=> 'Private',
						'Institutional' => 'Institutional',
						'Both'			=> 'Both'
					)
				)
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionstart',
				'id'   => 'oepl_brokerType',
			),
			array(
				'title'    => __( 'Broker Type', 'datum' ),
				'id'       => 'oepl_brokerType',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'css'      => '',
				'name'	   => 'brokertype_h',
				'function' => 'brokerType',
				'get_name' => 'getDMUserBrokerTypeId',
				'option'   => array(
					'brokertype_h' => array(
						'Sales' 		=> 'Sales',
						'Leasing'	 	=> 'Leasing',
						'br_Both'			=> 'Both'
					)
				)
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
		);
	}
	public function login_pages_edit_step_one($value='')
	{
		return
		array(
			array(
				'type' => 'section100',
				'id'   => '',
			),
				array(
					'type' => 'section66',
					'id'   => 'account_endpoint_options',
				),
					array(
						'title'    => __( 'First name<span>*</span>', 'datum' ),
						'id'       => '',
						'type'     => 'text',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'name'	   => 'first_name',
						'get_name' => 'getDMUserFirstName',
						'disabled' => '',
					),
					array(
						'title'    => __( 'Last name<span>*</span>', 'datum' ),
						'id'       => '',
						'type'     => 'text',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'disabled' => '',
						'get_name' => 'getDMUserLastName',
						'name'	   => 'last_name'
					),
					array(
						'title'    => __( 'Title', 'datum' ),
						'id'       => '',
						'type'     => 'text',
						'default'  => '',
						'class'    => '',
						'css'      => '',
						'disabled' => '',
						'get_name' => 'getDMUserTitle',
						'name'	   => 'title'
					),
                    array(
                        'title'    => __( 'Company', 'datum' ),
                        'id'       => '',
                        'type'     => 'select',
                        'default'  => '',
                        'class'    => '',
                        'css'      => '',
                        'disabled' => '',
                        'function' => 'companyList',
                        'get_name' => 'getDMUserCompanyId',
                        'name'	   => 'company'
                    ),
				array(
					'type' => 'sectionend',
					'id'   => 'account_endpoint_options',
				),
				array(
					'type' => 'section33',
					'id'   => '',
				),
						array(
							'title'    => __( 'Upload Photo', 'datum' ),
							'id'       => '',
							'type'     => 'file',
							'default'  => '',
							'class'    => '',
							'css'      => '',
							'disabled' => '',
							'get_name' => 'ProfileImage',
							'name'	   => 'avatar',
                            'register' => 'no'
						),
				array(
					'type' => 'sectionend',
					'id'   => 'account_endpoint_options',
				),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section100',
				'id'   => '',
			),
			array(
				'title'    => __( 'Street<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserStreet',
				'name'	   => 'street'
			),
			array(
				'title'    => __( 'Suite', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'name'	   => 'suite',
				'get_name' => 'getDMUserSuite',
			),
			array(
				'title'    => __( 'City<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'name'	   => 'city',
				'get_name' => 'getDMUserCity',
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section100',
				'id'   => '',
			),
			array(
				'title'    => __( 'State<span>*</span>', 'datum' ),
				'id'       => 'street_text_box',
				'type'     => 'text',
				'default'  => '',
				'disabled' => '',
				'class'    => 'state_text_id',
				'css'      => '',
				'get_name' => 'getDMUserState',
				'name'	   => 'state_text'
			),
			array(
				'title'    => __( 'State<span>*</span>', 'datum' ),
				'id'       => 'state_lead',
				'type'     => 'select',
				'default'  => '',
				'class'    => 'state_text_select',
				'css'      => '',
				'get_name' => 'getDMUserState',
				'name'	   => 'state_select',
				'function' => 'state_name',
			),
			array(
				'title'    => __( 'Country<span>*</span>', 'datum' ),
				'id'       => 'country_lead',
				'type'     => 'select',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'get_name' => 'getDMUserCountry',
				'name'	   => 'country',
				'function' => 'counry_name',
				'selected' => ''
			),
			array(
				'title'    => __( 'Zip Code<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserZipCode',
				'name'	   => 'zipcode'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section66',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Work Phone<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'input_class'    => 'phone_number',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserWorkPhone',
				'name'	   => 'cell_phone'
			),
			array(
				'title'    => __( 'Mobile Phone', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'input_class'    => 'phone_number',
				'css'      => '',
				'disabled' => '',
				'get_name' => 'getDMUserMobilePhone',
				'name'	   => 'mobile_phone'
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'section66',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Email Address<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'text',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'get_name' => 'getDMUserEmail',
				'disabled' => 'disabled',
				'name'	   => 'email'
			),
			array(
				'title'    => __( 'Password<span>*</span>', 'datum' ),
				'id'       => 'password',
				'type'     => 'password',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'get_name' => '',
				'name'	   => 'password',
				'disabled' => 'disabled',
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionstart',
				'id'   => 'account_endpoint_options',
			),
			array(
				'title'    => __( 'Industry Role<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'css'      => '',
				'disabled' => '',
				'name'	   => 'i_am',
				'get_name' => 'getDMUserIndustryRole',
				'function' => 'industryRole',
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionstart',
				'id'   => 'oepl_investor',
			),
			array(
				'title'    => __( 'Investor Type:', 'datum' ),
				'id'       => 'oepl_investor',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'function' => 'industryType',
				'css'      => '',
				'name'	   => 'investor_type',
				'get_name' => 'getDMUserInvestorTypeId',
				'option'   => array(
					'investor_type' => array(
						'Private' 		=> 'Private',
						'Institutional' => 'Institutional',
						'Both'			=> 'Both'
					)
				)
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionstart',
				'id'   => 'oepl_brokerType',
			),
			array(
				'title'    => __( 'Broker Type', 'datum' ),
				'id'       => 'oepl_brokerType',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'css'      => '',
				'name'	   => 'brokertype_h',
				'function' => 'brokerType',
				'get_name' => 'getDMUserBrokerTypeId',
				'option'   => array(
					'brokertype_h' => array(
						'Sales' 		=> 'Sales',
						'Leasing'	 	=> 'Leasing',
						'br_Both'			=> 'Both'
					)
				)
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
		);
	}

	public function login_pages_step_two($value='')
	{
		return
		array(
			array(
				'type' => 'sectionrow',
				'id'   => 'oepl_brokerType',
			),
			array(
				'title'    => __( 'In an Exchange<span>*</span>', 'datum' ),
				'id'       => '',
				'type'     => 'radio',
				'default'  => '',
				'class'    => 'demo',
				'name'	   => 'exchange_status',
				'css'      => '',
				'function'=> '',
				'option'   => array(
					'exchange_status' => array(
						'exchange' 		=> 'In an Exchange',
						'no_exchange' 	=> 'Not in an Exchange',
						'up_exchange'	=> 'Exchange Upcoming'
					)
				)
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
			array(
				'type' => 'sectionrow',
				'id'   => 'oepl_brokerType',
			),
			array(
				'title'    => __( 'Preferred Property Type', 'datum' ),
				'id'       => '',
				'type'     => 'checkbox',
				'default'  => '',
				'name'	   => 'property_type',
				'class'    => '',
				'css'      => '',
				'function' => 'PropetyType',
				'option'   => array(
					'property_type' => array(
						'Office' 		=> 'Office',
						'Flex'			=> 'R&amp;D/Flex',
						'Industrial'	=> 'Industrial',
						'Retail'		=> 'Retail',
						'Multifamily'	=> 'Multifamily',
						'Development'	=> 'Development',
						'Other'			=> 'Other',
					)
				)
			),

			array(
				'title'    => __( 'Preferred Markets', 'datum' ),
				'id'       => '',
				'type'     => 'checkbox',
				'default'  => '',
				'name'	   => 'markets',
				'class'    => '',
				'css'      => '',
				'function' => 'PeferredMarketType',
				'option'   => array(
					'markets' => array(
						'SoCal' 	=> 'SoCal',
						'NorCal'	=> 'NorCal',
						'Arizona'	=> 'Arizona',
						'Nevada'	=> 'Nevada',
						'Utah'		=> 'Utah',
						'Colorado'	=> 'Colorado',
						'Oregon'	=> 'Oregon',
						'Washington'=> 'Washington',
					)
				)
			),

			array(
				'title'    => __( 'Investment Strategy', 'datum' ),
				'id'       => '',
				'type'     => 'checkbox',
				'default'  => '',
				'class'    => '',
				'name'	   => 'investment_strategy',
				'css'      => '',
				'function' => 'InvestmentStraragy',
				'option'   => array(
					'investment_strategy' => array(
						'Core' 		=> 'Core',
						'Core-Plus'		=> 'Core-Plus',
						'Value-Add'		=> 'Value-Add',
						'Opportunistic'	=> 'Opportunistic',
						'single_tenant'	=> 'Single Tenant, NNN',
					)
				)
			),

			array(
				'title'    => __( 'Preferred Return Metrics', 'datum' ),
				'id'       => '',
				'type'     => 'checkbox',
				'default'  => '',
				'class'    => '',
				'name'	   => 'interests',
				'function' => 'ReturnMetrics',
				'css'      => '',
				'option'   => array(
					'interests' => array(
						'cap_rate' 				=> 'Cap Rate',
						'cash_on_cash_return'	=> 'Cash-on-Cash',
						'equity_multiple'		=> 'Equity Multiple',
						'IRR'					=> 'IRR',
						'price_per_squarefeet'	=> 'Price Per Squarefeet',
						'Return-on-Cost'		=> 'Return-on-Cost',
					)
				)
			),

			array(
				'title'    => __( 'Preferred Deal Size', 'datum' ),
				'id'       => '',
				'type'     => 'checkbox',
				'default'  => '',
				'class'    => '',
				'css'      => '',
				'name'	   => 'deal_size',
				'function' => 'PrefferedDealSize',
				'option'   => array(
					'deal_size' => array(
						'one_to_ten' 			=> '$1M-$10M',
						'ten_to_twentyfive'		=> '$10M-$25M',
						'twentyfive_to_fifty'	=> '$25M-$50M',
						'fifty_to_hundred'		=> '$50M-$100M',
						'hundredplus'			=> '$100M+',
					)
				)
			),
			array(
				'type' => 'sectionend',
				'id'   => 'account_endpoint_options',
			),
		);
	}

	public function login_pages_step($step)
	{
		if($step == 1){
			$data =	$this->login_pages_step_one();
		}else{
			$data =	$this->login_pages_step_two();
		}
		ob_start();
		$this->output_fields($data);
		return ob_get_clean();
	}

	public function login_pages_update_step($step)
	{
		if($step == 1){
			$data =	$this->login_pages_edit_step_one();
		}else{
			$data =	$this->login_pages_step_two();
		}
		ob_start();
		$this->output_fields($data);
		return ob_get_clean();
	}

	public function output_fields( $options ) {
		global $criteria;
		foreach ( $options as $value ) {
			// Switch based on type.
			switch ( $value['type'] ) {
				// Section Start.
				case 'sectionstart':
					echo "<div class='datum_row_group' id='".$value['id']."'>";
					break;
				case 'sectionrow':
					echo "<div class='datum_row' id='".$value['id']."'>";
					break;
				case 'section66':
					echo "<div class='datum_row_66' id='".$value['id']."'>";
					break;
				case 'section100':
					echo "<div class='datum_row_100' id='".$value['id']."'>";
					break;
				case 'section33':
					echo "<div class='datum_row_33' id='".$value['id']."'>";
					break;
				case 'sectioncol4':
					echo "<div class='datum_col_4' id='".$value['id']."'>";
					break;
				// Section Ends.
				case 'text':
				    if($value['name'] == "first_name") {
                        echo '<div class="datum_form_group '.$value['class'].'">
                            <label class="datum_label">'.$value['title'].'</label>
                            <input type="text" maxlength="50" class="datum_form-control '.$value['input_class'].'" value="'.get_user_value($value).'" name="'.$value['name'].'" id="'.$value['id'].'">
                            <span class="error js-error"></span>
                        </div>';
                    } elseif ($value['name'] == "last_name") {
                        echo '<div class="datum_form_group '.$value['class'].'">
                            <label class="datum_label">'.$value['title'].'</label>
                            <input type="text" maxlength="50" class="datum_form-control '.$value['input_class'].'" value="'.get_user_value($value).'" name="'.$value['name'].'" id="'.$value['id'].'">
                            <span class="error js-error"></span>
                        </div>';
                    } elseif ($value['name'] == "zipcode") {
                        echo '<div class="datum_form_group '.$value['class'].'">
                            <label class="datum_label">'.$value['title'].'</label>
                            <input type="text" maxlength="10" class="datum_form-control '.$value['input_class'].'" value="'.get_user_value($value).'" name="'.$value['name'].'" id="'.$value['id'].'">
                            <span class="error js-error"></span>
                        </div>';
                    } else {
                        echo '<div class="datum_form_group '.$value['class'].'">
                            <label class="datum_label">'.$value['title'].'</label>
                            <input type="text" class="datum_form-control '.$value['input_class'].'" value="'.get_user_value($value).'" name="'.$value['name'].'" id="'.$value['id'].'">
                            <span class="error js-error"></span>
                        </div>';
                    }

					break;
				case 'file':
				    $fileURL = ( getDMUserProfileImage() != null ) ? getDMUserProfileImage() : 'https://datumdocstorage.blob.core.windows.net/datumfilecontainer/placeholders/agent-placeholder.png';
				    if($value['register'] == 'yes') {
                        $title = $value['title'];
                    } else {
                        $title = ( getDMUserProfileImage() == null ) ? $value['title'] : '';
                    }
					echo '<div class="datum_profile_avatar">
							<div class="datum_avatar_holder">
								<img src="'.$fileURL.'" id="datum_file_show">
                  			</div>
      						<label class="datum_avatar_upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar"> <i>
      						<img src="'.DATUM_PLUGIN_URL.'/images/icons/edit-icon.png" class="img-fluid"></i>
        						<input type="file" name="'.$value['name'].'" id="profile_avatar">
        					</label>
      						<span id="datum_photo_hide">'.$title.'</span>
      						<span class="error js-error"></span>
      					</div>';

				break;
				case 'password':
					$changePassword = '';
					if(isset($_COOKIE['access_token']) && $_COOKIE['access_token'] != '') {
						$changePassword = '<a class="datum_model_open datum-change-password" data-popup="change_password_popup">Change Password</a>';
					}
					echo '<div class="datum_pw_box datum_form_group '.$value['class'].'">
                        <label class="datum_label"> '.$value['title'].'</label>
                        <input type="password" '.$value['disabled'].' class="datum_form-control datum_passfield '.$value['input_class'].'" id="'.$value['id'].'" name="'.$value['name'].'" value="">
                        <span toggle="#'.$value['id'].'" class="fa fa-eye-slash field-icon toggle-password-h npcg_np1 show_password_texbox"></span>
						'.$changePassword.'
                    </div>';
					break;
				case 'gape':
					echo '<div class="col-md-4"></div>';
					break;
				case 'radio':
					if($value['name'] == 'exchange_status'){
						echo '<div class="">';
					}else{

					}
					echo '<div class="datum_form_group">';
					echo '<label class="datum_label">'.$value['title'].'</label>';
					echo '<div class="datum_row">';
	                if($value['function'] != ''){
						foreach ($value['function']() as $key => $va) {
							echo '<div class="datum_custom_radio">
                                    <input type="radio" '.get_user_value($value,$key).' class="datum_custom_control_input" id="'.$value['name'].'_'.$key.'" name="'.$value['name'].'" value="'.$key.'">
                                    <label class="custom-control-label" for="'.$value['name'].'_'.$key.'">'.$va.'</label>
                                </div>';
						}
					}
					echo '</div>';
					echo '<span class="error js-error"></span></div>';

					break;
				case 'checkbox':
					//pr($criteria);
	                if($value['function'] == ''){
						echo '<div class="datum_form_group">';
		                  	echo '<label class="datum_label">'.$value['title'].'</label>';
		                  	echo '<div class="datum_row">';
		                  		foreach ($value['option'] as $key => $va) {
									foreach ($va as $k => $v) {
				                    	echo '<div class="datum_custom_checkbox">';
				                      		echo '<input type="checkbox"  class="custom-control-input" id="'.$k.'" name="'.$key.'[]" value="'.$k.'">';
				                      		echo '<label class="custom-control-label" for="'.$k.'">'.$v.'</label>';
				                    	echo '</div>';
				                    }
				               	}
		                    echo '</div>';
		                echo '</div>';
				    }else{

				    }
					break;
				case 'select':
					echo '<div class="datum_form_group '.$value['class'].'"">';
						echo '<label class="datum_label">'.$value['title'].'</label>';
						echo '<select class="datum_custom_select state_dropdown datum_form-control" id="'.$value['id'].'" name="'.$value['name'].'">';
						if(isset($value['function']) && $value['function'] != ''){
							if($value['function'] == 'companyList'){
								echo '<option value="">Select Company</option>';
								foreach ($value['function']() as $k1 => $v1) {
									//if($value['selected'] == $k1){ $selected = 'selected'; }else { $selected = ''; }
                                    if(getDMUserCompanyId() == $v1->Id) { $selected = "selected"; } else { $selected = ""; }
									echo '<option value="'.$v1->Id.'" '.$selected.'>'.$v1->CompanyName.'</option>';
								}
							}else if($value['function'] == 'state_name'){
								echo '<option value="">Select State</option>';
								foreach ($value['function']() as $k1 => $v1) {
									//if($value['selected'] == $k1){ $selected = 'selected'; }else { $selected = ''; }
                                    if(getDMUserState() == $v1->Code) { $selected = "selected"; } else { $selected = ""; }
									echo '<option value="'.$v1->Code.'" '.$selected.'>'.$v1->StateName.'</option>';
								}
							}elseif($value['function'] == 'counry_name'){
								echo '<option value="">Select Country</option>';
								echo '<option value="US">United States</option>';
								foreach ($value['function']() as $k1 => $v1) {
									//if($value['selected'] == $k1){ $selected = 'selected'; }else { $selected = ''; }
									echo '<option value="'.$v1->Code.'" '.get_user_value($value,$v1->Code,'select').'>'.$v1->CountryName.'</option>';
								}
							}
							else{
								foreach ($value['function']() as $k1 => $v1) {
									if($value['selected'] == $k1){ $selected = 'selected'; }else { $selected = ''; }
									echo '<option '.get_user_value($value,$k1).' value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
								}
							}
						}else{
							foreach ($value['option'] as $key => $va) {
								foreach ($va as $k => $v) {
									echo '<option value="'.$k.'">'.$v.'</option>';
								}
							}
						}
						echo '</select><span class="error js-error"></span>';
					echo '</div>';
					break;
				case 'sectionend':
					echo "</div>";
					# code...
					break;

				default:
					break;
			}
		}
	}

	public function loginProcess($value='')
	{
		$error = $this->validate($_POST);
		if($error){
	 		$response = array(
	            'type' => 'failure',
	            'html' => $error
			);
	 	}else{

	 	}
	 	return $response;
	}
	public function validate($data = null)
	{
		$error =array();
		foreach ($data as $key => $value) {
			switch ($key) {
				case 'user_password':
				case 'new_password':
				case 're_password':
					if(empty($value)){
						$error[$key] = self::DEFAULT_VALIDATION_MSG;
					}
					break;
				case 'membership_email':
					if(empty($value)){
						$error[$key] = self::DEFAULT_VALIDATION_MSG;
					}elseif (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
					    $error[$key] = $value ." is not a valid email address.";
					}
					break;
			case 'f_membership_email':
					if(empty($value)){
						$error[$key] = self::DEFAULT_VALIDATION_MSG;
					}elseif (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
					    $error[$key] = $value ." is not a valid email address.";
					}
					break;
				default:
					break;
			}
		}
		if(isset($data['new_password']) && isset($data['re_password'])){
			 if(!empty($data['new_password']) && !empty($data['re_password'])){
                if($data['new_password'] != $data['re_password'])
                {
					$error['re_password'] = "The password combination does not match.";
				}
			}
		}

		return $error;
	}
	public function forgotContinueProcess($data = null){
		$error = $this->validate($data);
		if($error){
	 		$response = array(
	            'type' => 'failure',
	            'html' => $error
			);

		}else{
			$user_id = email_exists($data['f_membership_email']);
			if($user_id){
				$url = 'f_membership_email='.$data['f_membership_email'].'&user_id='.$user_id;
				update_user_meta($user_id,'user_forgot_token',base64_encode($url));
				$mail = new Email();
				//user email
				$user_to 		= $data['f_membership_email'] ;
				$user_subject 	= "CarPartner: Forgot Password";
				ob_start();
				require_once( dirname( MEMBERSHIP ) . '/email/forgotpassword.php' );
				$user_message 	= ob_get_clean();
				$mail->membershipMail($user_to,$user_subject,$user_message);
				$response = array(
		            'type' => 'success',
		            'html' => array('A reset password link has been sent to your registered email.'),
				);
			}else{
				$response = array(
		            'type' => 'failure',
		            'html' => array('f_membership_email'=>'Entered email does not exist.'),
				);
			}
		}
		return $response;
	}
	public function passwordChangeProcess($data = null){
		$error = $this->validate($data);

		if($error){
	 		$response = array(
	            'type' => 'failure',
	            'html' => $error
			);

		}else{

			wp_set_password($data['new_password'], $data['user_id']);
			delete_user_meta($data['user_id'],'user_forgot_token');
			$response = array(
	            'type' => 'success',
	            'html' => array('Your password has been changed'),
			);
		}
		return $response;
	}
}
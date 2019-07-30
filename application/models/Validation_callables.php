<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Validation_callables Model
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2018, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class Validation_callables extends MY_Model {

	/**
	 * undocumented method
	 */
	public function __construct()
	{
		parent::__construct();

		$this->config->load('password_strength');
		$this->load->helper('date');
	}
	
	// -----------------------------------------------------------------------

	/**
	 * Check the supplied password strength.
	 * Please keep in mind that this is a very rudimentary way to check 
	 * password strength. Some devs may consider rolling their own solution,
	 * or possibly using something like zxcvbn instead. Zxcvbn is available
	 * at https://github.com/dropbox/zxcvbn
	 * 
	 * @param   string  the supplied password 
	 * @return  mixed   bool
	 */
	public function _check_password_strength( $password )
	{
		// Password length
		$max = config_item('max_chars_for_password') > 0
			? config_item('max_chars_for_password') 
			: '';
		$regex = '(?=.{' . config_item('min_chars_for_password') . ',' . $max . '})';
		$error = 'At least ' . config_item('min_chars_for_password') . ' characters<br />';

		if( config_item('max_chars_for_password') > 0 )
			$error .= 'Not more than ' . config_item('max_chars_for_password') . ' characters<br />';
		
		// Digit(s) required
		if( config_item('min_digits_for_password') > 0 )
		{
			$regex .= '(?=(?:.*[0-9].*){' . config_item('min_digits_for_password') . ',})';
			$plural = config_item('min_digits_for_password') > 1 ? 's' : '';
			$error .= '' . config_item('min_digits_for_password') . ' number' . $plural . '<br />';
		}
		
		// Lower case letter(s) required
		if( config_item('min_lowercase_chars_for_password') > 0 )
		{
			$regex .= '(?=(?:.*[a-z].*){' . config_item('min_lowercase_chars_for_password') . ',})';
			$plural = config_item('min_lowercase_chars_for_password') > 1 ? 's' : '';
			$error .= '' . config_item('min_lowercase_chars_for_password') . ' lower case letter' . $plural . '<br />';
		}
		
		// Upper case letter(s) required
		if( config_item('min_uppercase_chars_for_password') > 0 )
		{
			$regex .= '(?=(?:.*[A-Z].*){' . config_item('min_uppercase_chars_for_password') . ',})';
			$plural = config_item('min_uppercase_chars_for_password') > 1 ? 's' : '';
			$error .= '' . config_item('min_uppercase_chars_for_password') . ' upper case letter' . $plural . '<br />';
		}
		
		// Non-alphanumeric char(s) required
		if( config_item('min_non_alphanumeric_chars_for_password') > 0 )
		{
			$regex .= '(?=(?:.*[^a-zA-Z0-9].*){' . config_item('min_non_alphanumeric_chars_for_password') . ',})';
			$plural = config_item('min_non_alphanumeric_chars_for_password') > 1 ? 's' : '';
			$error .= '' . config_item('min_non_alphanumeric_chars_for_password') . ' non-alphanumeric character' . $plural . '<br />';
		}
		
		if( preg_match( '/^' . $regex . '.*$/', $password ) )
		{
			return TRUE;
		}

		$this->form_validation->set_message('enforce_password_strength', $error);
		return FALSE;
	}

	// --------------------------------------------------------------

	public function _validate_date($date)  {
		$error = 'Date '.$date.' must be a valid date value';

		$check = strtotime($date);
		if ($check !== FALSE)  {
			return TRUE;
		}
		$this->form_validation->set_message('validate_date', $error);

		return FALSE;
	}

	public function _date_greater_than($start, $end)  {
		$error = 'Date '.$end.' must be after '.$start.' date.';

 		$check_start = strtotime($start);
		$check_end = strtotime($end);
		if ($check_start <= $check_end)  {
			return TRUE;
		}
		$this->form_validation->set_message('date_greater_than', $error);

		return FALSE;
	}

	public function _validate_state_id($state, $state_id_no)  {
		switch ($state)  {
			case 'alabama':
				$regex = '^[a-zA-Z0-9]{1}\d{6}$';
				$error = 'Alabama ID 7 numeric or 1 letter + 6 numeric';
				break;
			case 'alaska':
				$regex = '^\d{7}$';
				$error = 'Alaska ID 7 numeric';
				break;
			case 'arizona':
				$regex = '^[ABDY0-9]{1}\d{8}$';
				$error = 'Arizona ID SSN, or (A, B, D, or Y) + 8 numeric';
				break;
			case 'arkansas':
				$regex = '^\d{9}$';
				$error = 'Arkansas ID 8 numeric with 0 in front or 9 numeric';
				break;
			case 'california':
				$regex = '^[a-zA-Z]{1}\d{7}$';
				$error = 'California ID 1 letter + 7 numeric';
				break;
			case 'colorado':
				$regex = '';  ## No rules yet
				$error = '';
				break;
			case 'connecticut':
				$regex = '^\d{9}$';
				$error = 'Connecticut ID 9 numeric';
				break;
			case 'delaware':
				$regex = '^\d{1,7}$';
				$error = 'Delaware ID 1 to 7 numeric';
				break;
			case 'districtofcolumbia':
				if (strlen($state_id_no) === 7)  {
					$regex = '^\d{7}$';
				}  else  {
					$regex = '^\d{9}$';
				}
				$error = 'District of Columbia 7 or 9 numeric';
				break;
			case 'florida':
				$regex = '^[a-zA-Z]{1}\d{12}$';
				$error = 'Florida ID 1 letter 12 numeric';
				break;
			case 'georgia':
				$regex = '^\d{7,9}$';  ## validate number of numeric
				$error = 'Georgia ID 7 - 9 numeric';
				break;
			case 'hawaii':
				$regex = '^[H0-9]{1}\d{8}$';
				$error = 'Hawaii ID 9 numeric or H + 8 numeric';
				break;
			case 'idaho':
				$regex = '^[a-zA-Z0-9]{2}\d{6}[a-zA-Z0-9]{1}$';
				$error = 'Idaho ID 2 letters + 6 numeric + 1 letter or 9 numeric';
				break;
			case 'illinois':
				$regex = '^[a-zA-Z]{1}\d{11}$';
				$error = 'Illinois ID 1 letter + 11 numeric';
				break;
			case 'indiana':
				$regex = '^[a-zA-Z0-9]{1}\d{9}$';
				$error = 'Indiana ID 10 numeric or 1 letter + 9 numeric';
				break;
			case 'iowa':
				$regex = '^\d{3}[a-zA-Z0-9]{2}\d{4}$';
				$error = 'Iowa ID 9 numeric or 3 numeric + 2 letters + 4 numeric';
				break;
			case 'kansas':
				$regex = '^[K0-9]{1}\d{8}$';
				$error = 'Kansas ID 9 numeric or K + 8 numeric';
				break;
			case 'kentucky':
				$regex = '^[a-zA-Z]{1}\d{8}$';
				$error = 'Kentucky ID 1 letter + 8 numeric';
				break;
			case 'louisiana':
				$regex = '^\d{9}$';
				$error = 'Louisiana ID 9 numeric';
				break;
			case 'maine':
				$regex = '^\d{7}$';
				$error = 'Maine ID 7 numeric';
				break;
			case 'maryland':
				$regex = '^[a-zA-Z]{1}\d{12}$';
				$error = 'Maryland ID 1 letter + 12 numeric';
				break;
			case 'massachusetts':
				$regex = '^[S0-9]{1}\d{8}$';
				$error = 'Massachusetts ID S + 8 numeric or 9 numeric';
				break;
			case 'michigan':
				$regex = '^[a-zA-Z]{1}\d{12}$';
				$error = 'Michigan ID 1 letter + 12 numeric';
				break;
			case 'minnesota':
				$regex = '^[a-zA-Z]{1}\d{12}$';
				$error = 'Minnesota 1 letter + 12 numeric';
				break;
			case 'mississippi':
				$regex = '^\d{9}$';
				$error = 'Mississippi ID 9 numeric';
				break;
			case 'missouri':
				$regex = '[a-zA-Z0-9]{1}\d{5,9}';  ## Look up exact spec on count
				$error = 'Missouri ID 9 numeric or 1 letter + 5 to 9 numeric';
				break;
			case 'montana':
				if (strlen($state_id_no) === 9)  {
					$regex = '^[a-zA-Z0-9]{9}$';
				}  else  {
					$regex = '^\d{13}$';
				}
				$error = 'Montana ID 13 numeric or 9 characters';
				break;
			case 'nebraska':
				$regex = '[ABCEGHV]{1}\d{3,8}'; ## Check for numeric limit
				$error = 'Nebraska ID 1 letter (A, B, C, E, G, H, or V)  + 3 to 8 numeric';
				break;
			case 'nevada':
				if (strlen($state_id_no) === 10)  {
					$regex = '^\d{10}$';
				}  else if (strlen($state_id_no) === 12)  {
					$regex = '^\d{12}$';
				}  else  {
					$regex = '^X\d{8}$';
				}
				$error = 'Nevada ID 10 numeric or 12 numeric or X + 8 numeric';
				break;
			case 'newhamshire':
				$regex = '^\d{2}[a-zA-Z]{3}\d{5}$';
				$error = 'New Hamshire ID 2 numeric + 3 letters + 5 numeric';
				break;
			case 'newjersey':
				$regex = '^[a-zA-Z]{1}\d{14}$';
				$error = 'New Jersey 1 letter + 14 numeric';
				break;
			case 'newmexico':
				$regex = '^\d{9}$';
				$error = 'New Mexico ID 9 numeric';
				break;
			case 'newyork':
				if (strlen($state_id_no) === 9)  {
					$regex = '^\d{9}$';
				}  else  {
					$regex = '^[a-zA-Z]{1}\d{18}$';
				}
				$error = 'New York ID 9 numeric or 1 letter + 18 numeric';
				break;
			case 'northcarolina':
				$regex = '^\d{1,12}$'; ## Get spec's on length
				$error = 'North Carolina 1 to 12 numeric';
				break;
			case 'northdakota':
				$regex = '^[a-zA-Z0-9]{3}\d{6}$';
				$error = 'North Dakota ID 9 numeric or 3 letters + 6 numeric';
				break;
			case 'ohio':
				$regex = '^[a-zA-Z]{2}\d{6}$';
				$error = 'Ohio ID 2 letters + 6 numeric';
				break;
			case 'oklahoma':
				$regex = '^[a-zA-Z]?\d{9}$';
				$error = 'Oklahoma ID 1 letter + 9 numeric or 9 numeric';
				break;
			case 'oregon':
				$regex = '^\d{1,9}$';  ## Get spec's on numeric count
				$error = 'Oregon ID 1 to 9 numeric';
				break;
			case 'pennsylvania':
				$regex = '^\d{8}$';
				$error = 'Pennyslvania ID 8 numeric';
				break;
			case 'rhodeisland':
				$regex = '^[V0-9]{1}\d{6}$';
				$error = 'Rhode Island ID 7 numeric or V + 6 numeric';
				break;
			case 'southcarolina':
				$regex = '^\d{1,10}$';  ## Get spec's on numeric count
				$error = 'South Carolina 1 to 18 numeric';
				break;
			case 'southdakota':
				$regex = '^\d{6,9}$';  ## Get specifics on numeric count
				$error = 'South Dakota ID 6 or 8 numeric or ssn';
				break;
			case 'tennessee':
				$regex = '^\d{7,9}$';  ## Get specifics on numeric count
				$error = 'Tennessee ID 7 to 9 numeric';
				break;
			case 'texas':
				$regex = '^\d{8}$';
				$error = 'Texas ID 8 numeric';
				break;
			case 'utah':
				$regex = '^\d{4,9}$';  ## Get specifics on numeric count
				$error = 'Utah ID 4 to 9 numeric';
				break;
			case 'vermont':
				$regex = '^\d{7}[a-zA-Z0-9]{1}$';
				$error = 'Vermont ID 8 numeric or 7 numeric + 1 letter';
				break;
			case 'virginia':
				$regex = '^[a-zA-Z0-9]{1}\d{8}$';
				$error = 'Virginia ID 9 numeric or 1 letter + 8 numeric';
				break;
			case 'washington':
				if (strlen($state_id_no) === 12)  {
					$regex = '^[a-zA-Z]{1,5}[\*]{0,4}[a-zA-Z\*]{1}[a-zA-Z]{1}\d{3}[a-zA-Z0-9]{2}$';
				}  else  {
					$regex = '^\d{12}$';
				}
				$error = 'Washington ID incorrect format';
				break;
			case 'westvirginia':
				$regex = '^[a-zA-Z0-9]{7}$';
				$error = 'West Virginia 7 characters';
				break;
			case 'wisconsin':
				$regex = '^[a-zA-Z]{1}\d{13}$';
				$error = 'Wisconsin ID 1 letter + 13 numeric';
				break;
			case 'wyoming':
				$regex = '^\d{9}$';
				$error = 'Wyoming ID 9 numeric';
				break;
		}
		
		if (preg_match('/'.$regex.'/i', $state_id_no))  {
			return TRUE;
		}
		$this->form_validation->set_message('validate_state_id', $error);

		return FALSE;
	}

}

/* End of file Validaton_callables.php */
/* Location: /community_auth/models/examples/Validation_callables.php */

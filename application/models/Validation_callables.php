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

}

/* End of file Validaton_callables.php */
/* Location: /community_auth/models/examples/Validation_callables.php */

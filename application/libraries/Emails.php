<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails {

	public function __construct($params = array())
	{
		$this->CI =& get_instance();

		$this->CI->load->helper('email');
	}
}

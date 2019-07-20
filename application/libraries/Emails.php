<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails {

	public function send($to = FALSE, $msg = FALSE)  {
		if ($to !== FALSE && $msg !== FALSE)  {
			$this->email->to($to);
        		$this->email->from('jo@activist');
        		$this->email->subject('Password Reset');
        		$this->email->message($msg);
        		$this->email->send();
		}

		return FALSE;
	}

	public function __construct($params = array())
	{
		$this->CI =& get_instance();

		$this->CI->load->helper('email');
		$this->CI->load->config('emails');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails {

	private function configure()  {
		$config['protocol'] = config_item('protocol');
		$config['mailpath'] = config_item('mailpath');
		$config['charset'] = config_item('charset');
		$config['wordwrap'] = config_item('wordwrap');

		return $config;
	}

	public function send($to = FALSE, $msg = FALSE)  {
		if ($to !== FALSE && $msg !== FALSE)  {
			$this->CI->email->to($to);
        		$this->CI->email->from('jo@activist');
        		$this->CI->email->subject('Password Reset');
        		$this->CI->email->message($msg);
        		$this->CI->email->send();
		}

		return FALSE;
	}

	public function __construct($params = array())  {
		$this->CI =& get_instance();

		$this->CI->load->library('email');
		$this->CI->load->config('emails');
	}
}

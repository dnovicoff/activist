<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails {

	private function configure()  {
		$config['protocol']    = config_item('protocol');
		$config['smtp_host']    = config_item('smtp_host');
		$config['smtp_port']    = config_item('smtp_port');
		$config['smtp_timeout'] = config_item('smtp_timeout');
		$config['smtp_user']    = config_item('smtp_user');
		$config['smtp_pass']    = config_item('smtppass');
		$config['charset']    = config_item('charset');
		$config['newline']    = config_item('newline');
		$config['mailtype'] = config_item('mailtype'); // or html
		$config['validate'] = config_item('validate'); // bool whether to validate email or not      

		$config['mailpath'] = config_item('mailpath');
		$config['wordwrap'] = config_item('wordwrap');

		return $config;
	}

	public function send($to = FALSE, $msg = FALSE)  {
		if ($to !== FALSE && $msg !== FALSE)  {
			## $this->CI->email->initialize($this->configure());

			$this->CI->email->to($to);
        		$this->CI->email->from('jo@activist.com');
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

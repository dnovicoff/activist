<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form_helper');
	}

	public function loc()  {

	}

	public function cam()  {

	}

	public function logout()  {
		$this->authentication->logout();

		$redirect_protocol = USE_SSL ? 'https' : NULL;

		redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
	}

        public function index($page = 'index')
        {
		$tmp = array(
			"data" => array(
        			"title" => ucfirst($page), // Capitalize the first letter
				"door" => $page
			)
		);

		if (!file_exists(APPPATH.'views/user/index.php'))
		{
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		$this->is_logged_in();
		if (!empty($this->auth_role))  {
        		$this->load->view('templates/header', $tmp);
       			$this->load->view('user/index', $tmp);
        		$this->load->view('templates/footer', $tmp);
		}  else  {
			redirect('/', 'refresh');
		}
	}
}

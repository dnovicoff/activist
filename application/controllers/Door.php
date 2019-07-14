<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Door extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form_helper');
		$this->load->library('user_agent');
	}

	private function generate_page($tmp = array())  {
		$this->setup_login_form();

        	$html = $this->load->view('templates/header', $tmp, TRUE);
       		$html .= $this->load->view('door/index', $tmp, TRUE);
        	$html .= $this->load->view('templates/footer', $tmp, TRUE);

		echo $html;
	}

	public function pass()  {
		if ($this->uri->uri_string() == 'door/pass')
			show_404();

		$this->load->library('forms');

		$tmp = array(
			"data" => array(
        			"title" => ucfirst("Account reset") // Capitalize the first letter
			)
		);

		if ($this->forms->validate('pass'))  {
			if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )  {
				echo "Here";
			}
		}

		$this->generate_page();
	}

	public function create()  {
		if ($this->uri->uri_string() == 'door/create')
			show_404();

		$this->load->library('forms');

		$tmp = array(
			"data" => array(
        			"title" => ucfirst("Create user") // Capitalize the first letter
			)
		);

		if ($this->forms->validate('user'))  {
			if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )  {
				
			}
		}

		$this->generate_page();
	}

	public function login()  {
		// Method should not be directly accessible
		if ($this->uri->uri_string() == 'door/login')
			show_404();

		$this->load->library('forms');

		$tmp = array(
			"data" => array(
        			"title" => ucfirst("Authentication") // Capitalize the first letter
			)
		);

		if ($this->forms->validate('auth'))  {
			if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )  {
				if ($this->require_min_level(9))  {
					redirect('admin', 'refresh');
				}
			}
		}

		$this->generate_page();
	}

        public function index($page = 'index')  {
		if (!file_exists(APPPATH.'views/door/index.php'))
		{
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		// $this->is_logged_in();
		if (!$this->verify_min_level(9))  {
			$this->generate_page();
		}  else  {
			redirect('admin', 'refresh');
		}
	}
}

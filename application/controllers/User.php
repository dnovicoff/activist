<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
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
       		$html .= $this->load->view('user/index', $tmp, TRUE);
        	$html .= $this->load->view('templates/footer', $tmp, TRUE);

		echo $html;
	}

	public function loc()  {
		$tmp = array(
			'data' => array(
			)
		);

		$this->is_logged_in();
		if (!empty($this->auth_role))  {
        		$this->load->view('templates/header', $tmp);
       			$this->load->view('user/index', $tmp);
        		$this->load->view('templates/footer', $tmp);
		}  else  {
			redirect($this->input->server, 'refresh');
		}
	}

	public function cam()  {
		$tmp = array(
			'data' => array(
        			"title" => ucfirst("cam"), // Capitalize the first letter
				"door" => "cam"
			)
		);

		$this->load->library('forms');

		$this->is_logged_in();
		if (!empty($this->auth_role))  {
			if ($this->forms->validate($tmp))  {
        			
			}
			$this->generate_page($tmp);
		}  else  {
			redirect($this->input->server, 'refresh');
		}
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
			redirect($this->input->server, 'refresh');
		}
	}
}

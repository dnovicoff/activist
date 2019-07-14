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
		$this->load->model('activist_model');
	}

	private function generate_page($tmp = array())  {
        	$html = $this->load->view('templates/header', $tmp, TRUE);
       		$html .= $this->load->view('user/index', $tmp, TRUE);
        	$html .= $this->load->view('templates/footer', $tmp, TRUE);

		echo $html;
	}

	public function search($cam_id = NULL)  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("cam_search"), // Capitalize the first letter
				'door' => 'cam_search'
			)
		);

		$this->load->library('forms');
		if ($this->forms->validate($tmp))  {
			echo "Success my brotha";
		}  else  {
			$this->generate_page($tmp);
		}
	}

        public function index($page = 'index')
        {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst($page), // Capitalize the first letter
				'door' => $page
			)
		);

		if (!file_exists(APPPATH.'views/user/index.php'))  {
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		$this->generate_page($tmp);
	}
}

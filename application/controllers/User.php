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
		$tmp['data']['countries'] = $this->activist_model->get_countries();
		if (intval($tmp['data']['country']))  {
			$tmp['data']['states'] = $this->activist_model->get_states($this->input->post('country'));
		}

        	$html = $this->load->view('templates/header', $tmp, TRUE);
       		$html .= $this->load->view('user/index', $tmp, TRUE);
        	$html .= $this->load->view('templates/footer', $tmp, TRUE);

		echo $html;
	}

	public function search($cam_id = NULL)  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("Campaign search Results"), // Capitalize the first letter
				'country' => $this->input->post('country'),
				'state' => 'choose',
				'city' => 'choose'
			)
		);

		$this->load->library('forms');
		if ($this->forms->validate('cam_search'))  {
			## $tmp['data']['national'] = $this->activist_model->get_campaigns();
			if (strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post')  {
				if (!is_null($this->input->post('state')))  {
					$tmp['data']['state'] = $this->input->post('state');
				}				
			}
		}
		$this->generate_page($tmp);
	}

        public function index($page = 'index')
        {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst('Campaign Search'), // Capitalize the first letter
				'country' => 'choose',
				'state' => 'choose',
				'city' => 'choose'
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

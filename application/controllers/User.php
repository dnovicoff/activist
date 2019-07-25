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
				'country' => 'choose',
				'state' => 'choose',
				'city' => 'choose',
				'login' => FALSE
			)
		);

		if ($this->verify_min_level(9))  {
			$tmp['data']['login'] = TRUE;
		}

		if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')  {
			$this->load->library('forms');

			$level = 0;
			$tmp['data']['country'] = (!is_null($this->input->post('country')) && is_numeric($this->input->post('country')) ? $this->input->post('country') : 'choose'); 
			if ($this->input->post('state') !== NULL && is_numeric($this->input->post('state')))  {
				$tmp['data']['state'] = $this->input->post('state');
				$level++;
			} 
			if ($this->input->post('city') !== NULL && !empty($this->input->post('city')) && $level > 0)  {
				$tmp['data']['city'] = $this->input->post('city');
				$level++;
			}

			if ($this->forms->validate('cam_search', $level))  {
				## National
				$tmp['data']['national_campaigns'] = $this->activist_model->get_campaigns($tmp['data']['country']);
				if (is_numeric($this->input->post('state')))  {
					## States
					$tmp['data']['state_campaigns'] = $this->activist_model
						->get_campaigns($this->input->post('country'), $tmp['data']['state']);

					if ($this->input->post('city') !== NULL)  {
						## City
						$tmp['data']['city_campaigns'] = $this->activist_model
							->get_campaigns($tmp['data']['country'], $tmp['data']['state'],
							$tmp['data']['city']);
					}
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
				'city' => 'choose',
				'login' => FALSE
			)
		);

		if (!file_exists(APPPATH.'views/user/index.php'))  {
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}

		if ($this->verify_min_level(9))  {
			$tmp['data']['login'] = TRUE;
		}
		
		$this->generate_page($tmp);
	}
}

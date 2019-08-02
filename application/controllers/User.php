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

		$this->is_logged_in();
	}

	private function page_prep($tmp = array())  {
		$tmp['data']['links'] =  array(
			'/cam' => 'Active',
			'/cam/search' => 'Drill',
			'/cam/national' => 'National',
			'/cam/current' => 'Current'
		);
		$tmp['data']['name'] = 'Search Types';

		$this->generate_page('user', $tmp);
	}

	public function testform($cam_id = FALSE)  {
		if (is_numeric($cam_id))  {
			$this->load->library('forms');
			if ($this->forms->validate('cam_id_test'))  {
				echo 'Validated';
			}  else  {
				echo form_error('id');
			}
		}
	}

	public function sign($cam_id = FALSE)  {
		$tmp = array(
			'data' => array(
				'title' => ' campaign signature'
			)
		);

		if (is_numeric($cam_id))  {
			$cam_data = $this->activist_model->get_campaign($cam_id);
			if (isset($cam_data) && is_array($cam_data))  {
				if ($cam_data[0]['region_name'] == 'National')  {
					$tmp['data']['logo'] = strtolower($cam_data[0]['country_name']);
				}  else if ($cam_data[0]['region_name'] == 'State')  {
					$tmp['data']['logo'] = strtolower($this->activist_model->get_state_name($cam_data[0]['table_key']));
				}  else  {
				}
				$tmp['data']['logo'] = preg_replace('/\s/', '', $tmp['data']['logo']);
			}

			$this->load->library('forms');
			$tmp['data']['cam_id'] = $cam_id;

			if ($this->forms->validate('cam_sign'))  {
				echo "Here";
				exit();
			}
		}

		$this->page_prep($tmp);
	}

	public function detail($cam_id = FALSE)  {
		$tmp = array(
			'data' => array(
				'title' => ' campaign detail.'
			)
		);

		if (is_numeric($cam_id))  {
			$tmp['data']['campaign'] = $this->activist_model->get_campaign($cam_id);
			if (preg_match('/^0$/', $tmp['data']['campaign'][0]['table_key']))  {
				$tmp['data']['bgimage'] = $tmp['data']['campaign'][0]['country_name'];
			}  else if (preg_match('/\d{1,2}/', $tmp['data']['campaign'][0]['table_key']))  {
				$state = $this->activist_model->get_state_name($tmp['data']['campaign'][0]['table_key']);
				$tmp['data']['bgimage'] = $state;
			}  else  {

			}
		}

		$this->page_prep($tmp);
	}

	public function show($country_id = FALSE, $state_id = FALSE, $city = FALSE)  {
		$tmp = array(
			'data' => array(
				'title' => ' listings for activist campaigns'
			)
		);

		if (is_numeric($country_id) && is_bool($state_id) && is_bool($city))  {
			$tmp['data']['campaigns'] = $this->activist_model->get_campaigns($country_id);
		}  else if (is_numeric($country_id) && is_numeric($state_id) && is_bool($city))  {
			$tmp['data']['campaigns'] = $this->activist_model->get_campaigns($country_id, $state_id);
		}  else if (is_numeric($country_id) && is_numeric($state_id) && !empty($city))  {
			$tmp['data']['campaigns'] = $this->activist_model->get_campaigns($country_id, $state_id, $city);
		}

		$this->page_prep($tmp);
	}

	public function search()  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("Campaign search Results"), // Capitalize the first letter
				'validated' => FALSE,
				'country' => 'choose',
				'state' => 'choose',
				'city' => 'choose',
				'countries' => $this->activist_model->get_countries()
			)
		);

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
				$tmp['data']['valid_national'] = TRUE;
				$tmp['data']['national_campaigns'] = $this->activist_model->get_campaigns($tmp['data']['country']);
				if (is_numeric($this->input->post('state')))  {
					## States
					$tmp['data']['valid_state'] = TRUE;
					$tmp['data']['state_campaigns'] = $this->activist_model
						->get_campaigns($this->input->post('country'), $tmp['data']['state']);

					if ($this->input->post('city') !== NULL)  {
						## City
						$tmp['data']['valid_city'] = TRUE;
						$tmp['data']['city_campaigns'] = $this->activist_model
							->get_campaigns($tmp['data']['country'], $tmp['data']['state'],
							$tmp['data']['city']);
					}
				}
			}
			if (is_numeric($this->input->post('country')))  {
				$tmp['data']['states'] = $this->activist_model->get_states($this->input->post('country'));
			}
		}
		
		$this->page_prep($tmp);
	}

        public function index($page = 'index')  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst('Campaign Search') // Capitalize the first letter
			)
		);

		if (!file_exists(APPPATH.'views/user/index.php'))  {
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		$this->page_prep($tmp);
	}
}

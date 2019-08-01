<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
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
		$tmp['data']['links'] = array(
			'/admin' => 'Data',
			'/admin/group' => 'Groupings',
			'/admin/loc' => 'Create Location',
			'/admin/cam' => 'Create Campaign'
		);

		$this->generate_page('admin', $tmp);
	}

	public function data($cam_id = FALSE)  {
		$tmp = array(
			'data' => array(
				'title' => 'Campaign data'
			)
		);

		if ($this->require_role('admin'))  {
			if (is_numeric($cam_id))  {

			}
		}  else  {
			redirect($this->input->server.'/login', 'refresh');
		}

		$this->page_prep($tmp);
	}

	public function group()  {
		$tmp = array(
			'data' => array(
				'title' => 'Campaign / Location groupings',
				'user_id' => $this->auth_user_id,
				'loc_data' => FALSE,  // $loc_data = $this->activist_model->get_location_data($tmp['data']['user_id']);
				'cam_data' => $this->activist_model->get_campaign_data($this->auth_user_id)
			)
		);

		if ($this->require_role('admin'))  {		
			$this->page_prep($tmp);
		}  else  {
			redirect($this->input->server.'/login', 'refresh');
		}
	}

	public function loc($loc_id = NULL)  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("loc"), // Capitalize the first letter
				'user_id' => $this->auth_user_id
			)
		);

		if ($this->require_role('admin'))  {
			$this->page_prep($tmp);
		}  else  {
			redirect($this->input->server.'/login', 'refresh');
		}
	}

	public function cam($cam_method = NULL, $cam_id = NULL)  {
		$level = 0;
		$status = (!is_null($cam_method) ? $cam_method : 'insert');
		$functions = array('insert', 'select', 'update', 'delete');
		if (!in_array($status, $functions))  {
			show_404();
		}

		$tmp = array(
			'data' => array(
        			'title' => ucfirst("Create Campaign"), // Capitalize the first letter
				'user_id' => $this->auth_user_id,
				'hidden_data' => array('status' => $status),
				'countries' => $this->activist_model->get_countries(),
				'regions' => $this->activist_model->get_regions()
			)
		);

		$this->load->library('forms');
		if ($this->require_role('admin'))  {
			if ($this->input->post('state_id') !== NULL)
				$level = 2;
			if ($this->input->post('city') !== NULL && !empty($this->input->post('city')))
				$level = 3;
			if ($this->forms->validate('cam', $level))  {
        			$cam_data = [
					'user_id' => intval($this->auth_user_id),
					'created_at' => date('Y-m-d H:i:s'),
					'start_time' => $this->input->post('start_date').' 00:00:01',
					'end_time' => $this->input->post('end_date').' 23:59:59',
					'country_id' => $this->input->post('country_id'),
					'region_id' => $this->input->post('region_id')
				];

				if ($this->input->post('title') !== NULL && $this->input->post('cam_text') !== NULL)  {
					if ($this->input->post('state_id') !== NULL && is_numeric($this->input->post('state_id')))  {
						$cam_data['table_key'] = $this->input->post('state_id');
					}

					if (is_numeric($this->input->post('state_id')) && !empty($this->input->post('city')))
						$cam_data['city'] = $this->activist_model->get_city($this->input->post('state_id'),
							$this->input->post('city'));

					$cam_data['title'] = $this->input->post('title');
					$cam_data['text'] = $this->input->post('cam_text');

					if ($this->input->post('cam_id') !== NULL && is_numeric($this->input->post('cam_id'))
						&& !is_null($cam_id) && $cam_id = $this->input->post('cam_id'))  {
						$cam_data['cam_id'] = $cam_data['cam_id'] = $this->input->post('cam_id');
					}

					if (is_null($cam_method) && is_null($cam_id) && $status === "insert" &&
						$status === $this->input->post('status'))  {
						$cam_id = $this->activist_model->insert_campaign($cam_data);
					}  else if ($cam_method === 'update' && $status === $this->input->post('status') && 							is_numeric($cam_id) && $cam_id === $this->input->post('cam_id'))  {
						$this->activist_model->update_campaign($cam_data);
						$status = 'select';
					}
				}
				$level++;
				$tmp['data']['states'] = $this->activist_model->get_states($this->input->post('country_id'));
			}  else  {
				$tmp['data']['states'] = $this->activist_model->get_states($this->input->post('country_id'));
			}

			if (!is_null($cam_method) && !is_null($cam_id) && is_numeric($cam_id))  {
				switch ($status)  {
					case 'insert':
					case "select":
					case "update":
						$tmp['data']['cam_detail'] = $this->activist_model->get_campaign_data($this->auth_user_id, $cam_id);
						if (preg_match('/(\d{1,2})-(\d{1,5})/', $tmp['data']['cam_detail'][0]['table_key'], $matches))  {
							$tmp['data']['cam_detail'][0]['state_id'] = $matches[1];
							$tmp['data']['cam_detail'][0]['city'] =
								$this->activist_model->get_city($matches[1], $matches[2]);
							$tmp['data']['cam_detail'][0]['city'] =
								$tmp['data']['cam_detail'][0]['city'][0]['city'];
						}  else if ($tmp['data']['cam_detail'][0]['table_key'] !== "0")  {
							$tmp['data']['cam_detail'][0]['state_id'] = $tmp['data']['cam_detail'][0]['table_key'];
							$tmp['data']['cam_detail'][0]['city'] = '';
						}  else  {
							$tmp['data']['cam_detail'][0]['state_id'] = '';
							$tmp['data']['cam_detail'][0]['city'] = '';
						}
						$tmp['data']['states'] = $this->activist_model
							->get_states($tmp['data']['cam_detail'][0]['country_id']);
						break;
					case "delete":
						$tmp['data']['cam_detail'] = $this->activist_model->delete_campaign($this->auth_user_id, $cam_id);
						break;
				}
				$tmp['data']['hidden_data'] = array('status' => $status, 'cam_id' => $cam_id);
			}
			$tmp['data']['level'] = $level;
			$this->page_prep($tmp);
		}  else  {
			redirect($this->input->server.'/login', 'refresh');
		}
	}

	public function logout()  {
		$this->authentication->logout();

		$redirect_protocol = USE_SSL ? 'https' : NULL;

		redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
	}

        public function index($page = 'index')  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst($page), // Capitalize the first letter
				'user_id' => $this->auth_user_id
			)
		);

		if (!file_exists(APPPATH.'views/admin/index.php'))  {
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		if ($this->require_role('admin'))  {
			$this->page_prep($tmp);
		}  else  {
			redirect($this->input->server.'/login', 'refresh');
		}
	}
}

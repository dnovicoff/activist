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
	}

	private function generate_page($tmp = array())  {
		// $loc_data = $this->activist_model->get_location_data($tmp['data']['user_id']);
		$loc_data = FALSE;
		$cam_data = $this->activist_model->get_campaign_data($tmp['data']['user_id']);

		$tmp['data']['loc_data'] = $loc_data;
		$tmp['data']['cam_data'] = $cam_data;

        	$html = $this->load->view('templates/header', $tmp, TRUE);
       		$html .= $this->load->view('admin/index', $tmp, TRUE);
        	$html .= $this->load->view('templates/footer', $tmp, TRUE);

		echo $html;
	}

	public function loc($loc_id = NULL)  {
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("loc"), // Capitalize the first letter
				'door' => 'loc',
				'user_id' => $this->auth_user_id
			)
		);

		$this->is_logged_in();
		if ($this->require_role('admin'))  {
			$this->generate_page($tmp);
		}  else  {
			redirect($this->input->server, 'refresh');
		}
	}

	public function cam($cam_method = NULL, $cam_id = NULL)  {
		$status = (!is_null($cam_method) ? $cam_method : 'insert');
		$functions = array('insert', 'select', 'update', 'delete');
		if (!in_array($status, $functions))  {
			show_404();
		}

		$this->is_logged_in();
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("cam"), // Capitalize the first letter
				'door' => 'cam',
				'user_id' => $this->auth_user_id,
				'hidden_data' => array('status' => $status),
				'countries' => $this->activist_model->get_countries(),
				'regions' => $this->activist_model->get_regions()
			)
		);

		$this->load->library('forms');
		if ($this->require_role('admin'))  {
			if ($this->forms->validate('cam'))  {
        			$cam_data = [
					'user_id' => intval($this->auth_user_id),
					'created_at' => date('Y-m-d H:i:s'),
					'country_id' => $this->input->post('country_id'),
					'start_time' => $this->input->post('start_date').' 00:00:01',
					'end_time' => $this->input->post('end_date').' 23:59:59',
					'title' => $this->input->post('title'),
					'text' => $this->input->post('cam_text')
				];

				if ($this->input->post('cam_id') !== NULL)  {
					$cam_data['cam_id'] = $this->input->post('cam_id');
				}

				if (!isset($cam_data['cam_id']) && $status == "insert")  {
					$cam_id = $this->activist_model->insert_campaign($cam_data);
				}  else if ($status == "update" && isset($cam_data['cam_id']))  {
					$this->activist_model->update_campaign($cam_data);
					$status = 'select';
				}
			}
			if (!is_null($status) && !is_null($cam_id) && is_int(intval($cam_id)))  {
				switch ($status)  {
					case 'insert':
					case "select":
					case "update":
						$tmp['data']['cam_detail'] = $this->activist_model->get_campaign_data($this->auth_user_id, $cam_id);
						break;
					case "delete":
						$tmp['data']['cam_detail'] = $this->activist_model->delete_campaign($this->auth_user_id, $cam_id);
						break;
				}
				$tmp['data']['hidden_data'] = array('status' => $status, 'cam_id' => $cam_id);
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
		$this->is_logged_in();
		$tmp = array(
			'data' => array(
        			'title' => ucfirst($page), // Capitalize the first letter
				'door' => $page,
				'user_id' => $this->auth_user_id
			)
		);

		if (!file_exists(APPPATH.'views/admin/index.php'))
		{
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		if ($this->require_role('admin'))  {
			$this->generate_page($tmp);
		}  else  {
			redirect($this->input->server, 'refresh');
		}
	}
}

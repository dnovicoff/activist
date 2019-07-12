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
		// $this->setup_login_form();
		// $loc_data = $this->activist_model->get_loc	ation_data($tmp['data']['user_id']);
		$loc_data = FALSE;
		$cam_data = $this->activist_model->get_campaign_data($tmp['data']['user_id']);

		$tmp['data']['loc_data'] = $loc_data;
		$tmp['data']['cam_data'] = $cam_data;

        	$html = $this->load->view('templates/header', $tmp, TRUE);
       		$html .= $this->load->view('user/index', $tmp, TRUE);
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
		if (!empty($this->auth_role))  {
			$this->generate_page($tmp);
		}  else  {
			redirect($this->input->server, 'refresh');
		}
	}

	public function cam($cam_method = NULL, $cam_id = NULL)  {
		$status = (!is_null($cam_method) ? $cam_method : 'insert');

		$this->is_logged_in();
		$tmp = array(
			'data' => array(
        			'title' => ucfirst("cam"), // Capitalize the first letter
				'door' => 'cam',
				'user_id' => $this->auth_user_id,
				'hidden_data' => array('status' => $cam_method)
			)
		);

		$this->load->library('forms');
		if (!empty($this->auth_role))  {
			if ($this->forms->validate($tmp))  {
        			$cam_data = [
					'user_id' => intval($this->auth_user_id),
					'created_at' => date('Y-m-d H:i:s'),
					'start_time' => $this->input->post('start_date').' 00:00:01',
					'end_time' => $this->input->post('end_date').' 23:59:59',
					'title' => $this->input->post('title'),
					'text' => $this->input->post('cam_text')
				];

				if (is_null($cam_id))  {
					$id = $this->activist_model->insert_campaign($cam_data);
					$cam_data['cam_id'] = $id;
					$tmp['data']['hidden_data'] = array('form_edit' => FALSE);
				}  else  {
					$cam_data['cam_id'] = $cam_id;
					$this->activist_model->update_campaign($cam_data);
				}
			}
			if (!is_null($cam_method) && !is_null($cam_id))  {
				switch ($cam_method)  {
					case "display":
						$tmp['cam_detail'] = $this->activist_model->get_campaign_data($this->auth_user_id, $cam_id);
						break;
					case "update":
						$tmp['cam_detail'] = $this->activist_model->get_campaign_data($this->auth_user_id, $cam_id);
						break;
					case "delete":
						$tmp['cam_detail'] = $this->activist_model->delete_campaign($this->auth_user_id, $cam_id);
						break;
					case "data":
						break;
				}
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

		if (!file_exists(APPPATH.'views/user/index.php'))
		{
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		
		if (!empty($this->auth_role))  {
			$this->generate_page($tmp);
		}  else  {
			redirect($this->input->server, 'refresh');
		}
	}
}

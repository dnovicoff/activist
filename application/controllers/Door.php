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

		$this->is_Logged_in();
	}

	private function page_prep($tmp = array())  {
		$tmp['data']['links'] = array(
			'/login' => 'Login',
			'/pass' => 'Password',
			'/create' => 'New User'
		);
		$tmp['data']['name'] = 'Functions';

		$this->generate_page('door', $tmp);
	}

	public function recovery($user_id = '', $recovery_code = '')  {
		if ($this->uri->uri_string() == 'door/recovery')
			show_404();

		$tmp['data']['title'] = 'Password Recovery Stage 2';

		if ($on_hold = $this->authentication->current_hold_status(TRUE))  {
			$tmp['data']['disabled'] = 1;
		}  else  {
			$this->load->model('activist_model');
			$this->load->library('forms');

			if (is_numeric($user_id) && strlen($user_id) <= 10 && strlen($recovery_code) == 72 &&
				$recovery_data = $this->activist_model->get_recovery_verification_data($user_id))  {
				
				if( $recovery_data->passwd_recovery_code ==
					$this->authentication->check_passwd($recovery_data->passwd_recovery_code, $recovery_code))  {
					$tmp['data']['user_id']       = $user_id;
					$tmp['data']['username']     = $recovery_data->username;
					$tmp['data']['recovery_code'] = $recovery_data->passwd_recovery_code;
				}  else  {
					$tmp['data']['recovery_error'] = 1;
					$this->authentication->log_error('Link is bad '. $recovery_code);
				}
			}  else  {
				$tmp['data']['recovery_error'] = 1;
				$this->authentication->log_error('Link is bad '. $recovery_code);
			}

			if ($this->tokens->match)  {
				if ($this->forms->validate('recovery'))  {
					$this->activist_model->recovery_password_change();
				}
			}
		}
		
		$this->page_prep($tmp);
	}

	public function pass()  {
		if ($this->uri->uri_string() == 'door/pass')
			show_404();

		$tmp = array(
			"data" => array(
        			"title" => ucfirst("Account reset") // Capitalize the first letter
			)
		);

		$this->load->library('forms');
		$this->load->model('activist_model');
		if ($on_hold = $this->authentication->current_hold_status(TRUE))  {
			$tmp['data']['disabled'] = 1;
		}  else  {
			if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')  {
				if ($this->forms->validate('pass'))  {
					if ($this->tokens->match && $this->input->post('email'))  {
						if ($user_data = $this->activist_model->get_recovery_data($this->input->post('email')))  {
							if ($user_data->banned == '1')  {
								$this->authentication->log_error($this->input->post('email', TRUE));
								$tmp['data']['banned'] = 1;
							}  else  {
								$recovery_code = substr( $this->authentication->random_salt() 
									. $this->authentication->random_salt() 
									. $this->authentication->random_salt() 
									. $this->authentication->random_salt(), 0, 72);

								$this->activist_model->update_user_raw_data($user_data->user_id,  [
									'passwd_recovery_code' => $this->authentication->hash_passwd($recovery_code),
									'passwd_recovery_date' => date('Y-m-d H:i:s')
									]
								);

								$link_protocol = USE_SSL ? 'https' : NULL;
								$link_uri = base_url().'recovery/'.$user_data->user_id. 
									'/'.$recovery_code;

								$tmp['data']['special_link'] = anchor( 
									site_url( $link_uri, $link_protocol ), 
									site_url( $link_uri, $link_protocol ), 
									'target ="_blank"' 
								);

								$tmp['data']['confirmation'] = 1;

								$this->load->library('emails');
								$msg = "Account recovery process email verification.<br /><br /> ".
									"This link can be used to reset your password for activist. ".
									"Please note that the like provided will expire in 2 hours. ".
									"In that event just visit activist and generate another link.<br /> ".
									$link_uri;

								$tmp['data']['email'] = $this->emails->send($this->input->post('email'), $msg);
							}
						}  else  {
							$this->authentication->log_error($this->input->post('email', TRUE));
							$tmp['data']['no_match'] = 1;
						}
					}
				}
			}
		}

		$this->page_prep($tmp);
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

		if ($on_hold = $this->authentication->current_hold_status(TRUE))  {
			$tmp['data']['disabled'] = 1;
		}  else  {
			if ($this->forms->validate('user'))  {
				if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')  {
					$user_data['email']      = $this->input->post('email');
					$user_data['auth_level'] = 9;
					$user_data['passwd']     = $this->authentication->hash_passwd($this->input->post('password'));
					$user_data['user_id']    = $this->activist_model->get_unused_id();
					$user_data['created_at'] = date('Y-m-d H:i:s');

					// If username is not used, it must be entered into the record as NULL
					if (empty($user_data['username']))  {
						$user_data['username'] = NULL;
					}

					$id = $this->activist_model->insert_user($user_data);
					if (is_numeric($id))  {
						redirect('admin', 'refresh');
					}
				}
			}
		}

		$this->page_prep($tmp);
	}

	public function login()  {
		// Method should not be directly accessible
		if ($this->uri->uri_string() == 'door/login')
			show_404();

		$tmp = array(
			"data" => array(
        			"title" => ucfirst("Authentication"), // Capitalize the first letter
				'login' => TRUE
			)
		);

		$this->load->library('forms');
		if ($this->forms->validate('auth'))  {
			if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )  {
				if ($this->require_min_level(9))  {
					redirect('admin', 'refresh');
				}
			}
		}

		if ($this->require_role('admin'))  {
			redirect('/admin', 'refresh');
		}  else  {
			$this->page_prep($tmp);
		}
	}

        public function index($page = 'index')  {
		if (!file_exists(APPPATH.'views/door/index.php'))  {
                	// Whoops, we don't have a page for that!
			log_message('ERROR', 'Activist Error '.$page);
                	show_404();
		}
		$tmp['data']['title'] = ucfirst('Welcome');
	
		$this->page_prep($tmp);
	}
}

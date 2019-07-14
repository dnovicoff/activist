<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms {

	private function get_auth_rules()  {
		$auth_rules = [
			[
				'field' => 'login_string',
				'label' => 'email',
				'rules' => [
					'trim',
					'required',
					'valid_email', [
						'get_user',
						[  $this->CI->activist_model, 'get_user'  ]
					]
				],
				'errors' => [
					'get_user' => 'User %s does not exist'
				]
			],  [
				'field' => 'login_pass',
				'label' => 'password',
				'rules' => [
					'trim',
					'required',
					'min_length[8]',  [
						'enforce_password_strength',
						[  $this->CI->validation_callables, '_check_password_strength'  ]
					]
				],
				'errors' => [

				]
			]
		];

		return $auth_rules;
	}

	private function get_pass_rules()  {
		$pass_rules = [
			[
				'field' => 'email',
				'label' => 'email',
				'rules' => [
					'trim',
					'required',
					'valid_email',  [
						'get_user',
						[  $this->CI->activist_model, 'get_user'  ]
					]
				],
				'errors' => [
					'get_user' => 'User %s does not exist'
				]
			]
		];

		return $pass_rules;
	}

	private function get_user_rules()  {
		$user_rules = [
			[
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|required|valid_email|is_unique[users.email]',
				'errors' => [
					'is_unique'     => 'This %s already exists.'
				]
			],  [
				'field' => 'confirmemail',
				'label' => 'confirmemail',
				'rules' => 'trim|required|matches[email]|valid_email',
				'errors' => [
				]
			],  [
				'field' => 'password',
				'label' => 'password',
				'rules' => 'trim|required|min_length[8]',
				'errors' => [
				]
			],  [
				'field' => 'confirmpassword',
				'label' => 'Password Confirmation',
				'rules' => [
					'trim',
					'required',
					'matches[password]',  [
						'enforce_password_strength',
						[  $this->CI->validation_callables, '_check_password_strength'  ]
					]
				],
				'errors' => [
					'required' => 'You must provide a %s.',
					'enforce_pass' => 'Password must be at least 8 alphanumeric characters with one uppercase'
				]
			]
		];

		return $user_rules;
	}

	private function get_cam_rules()  {
		$cam_rules = [
			[
				'field' => 'start_date',
				'label' => 'start_date',
				'rules' => [
					'trim',
					'required',
					'regex_match[/^\d{4}-\d{2}-\d{2}$/]',  [
						'validate_date',
						[  $this->CI->validation_callables,  '_validate_date'  ]
					]
				],
				'errors' => [
					'regex_match' => 'Date muse be in form yyyy-mm-dd'
				]
			],  [
				'field' => 'end_date',
				'label' => 'end_date',
				'rules' => [
					'trim',
					'required',
					'regex_match[/^\d{4}-\d{2}-\d{2}$/]',  [
						'validate_date',
						[  $this->CI->validation_callables,  '_validate_date'  ]
					],  [
						'date_greater_than',
						function ($end)  {
 							$check_start = strtotime($this->CI->input->post('start_date'));
							$check_end = strtotime($end);
							if ($check_start <= $check_end)  {
								return TRUE;
							}
							$error = 'Date '.$end.' must be after '.$this->CI->input->post('start_date').' date.';
							$this->CI->form_validation->set_message('date_greater_than', $error);
							
							return FALSE;
						}
					]
				],
				'errors' => [
					'regex_match' => 'Date muse be in form yyyy-mm-dd'
				]
			],  [
				'field' => 'title',
				'label' => 'title',
				'rules' => 'trim|required|alpha_numeric_spaces',
				'errors' => [
				]
			],  [
				'field' => 'cam_text',
				'label' => 'cam_text',
				'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9\s\.\?!\']+$/]',
				'errors' => [
					'regex_match' => 'Only alpha numeric, spaces, and punctuation characters are allowed'
				]
			]
		];

		return $cam_rules;
	}

	private function get_cam_search_rules()  {
		$cam_search_rules = [
			[
				'field' => 'region',
				'label' => 'region',
				'rules' => [
					'trim',
					'required',
					'regex_match[/^(?!choose)/]'
				],
				'errors' => [
					'regex_match' => 'Please choose a region to start search'
				]
			],  [
				'field' => 'state',
				'label' => 'state',
				'rules' => [
					'trim',
					'regex_match[/!choose/]'
				],
				'errors' => [
				]
			],  [
				'field' => 'city',
				'label' => 'city',
				'rules' => [
					'trim',
					'regex_match[/!choose/]'
				],
				'errors' => [
				]
			]
		];

		return $cam_search_rules;
	}

	private function validate_form($rule)
	{
		$inputs = array();
		switch ($rule)  {
			case "user":
				$inputs['email'] = $this->CI->input->post('email');
				$inputs['pass'] = password_hash($this->CI->input->post('password'), PASSWORD_DEFAULT);
				$this->CI->form_validation->set_rules($this->get_user_rules());
				break;
			case "pass":
				$inputs['email'] = $this->CI->input->post('email');
				$this->CI->form_validation->set_rules($this->get_pass_rules());
				break;
			case "auth":
				$this->CI->form_validation->set_rules($this->get_auth_rules());
				break; 
			case 'cam':
				$this->CI->form_validation->set_rules($this->get_cam_rules());
				break;
			case 'cam_search':
				$this->CI->form_validation->set_rules($this->get_cam_search_rules());
				break;
		}

    		if ($this->CI->form_validation->run() !== FALSE)  {
			switch ($rule)  {
				case "user":
					break;
				case "pass":
					break;
				case "auth":
					break;
			}
			return TRUE;
		}

		return FALSE;
	}

	public function validate($rule = NULL)  {
                if (!file_exists(APPPATH.'views/user/index.php'))  {
                	// Whoops, we don't have a page for that!
                	show_404();
		}

        	return $this->validate_form($rule);
        }

	public function __construct($params = array())
	{
		$this->CI =& get_instance();

		$this->CI->load->helper('form');
    		$this->CI->load->library('form_validation');
		$this->CI->load->model('validation_callables');
		$this->CI->load->model('activist_model');
		$this->CI->config->load('forms');
	}
}

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
					'required' => 'You must provide a %s.'
				]
			]
		];

		return $user_rules;
	}

	private function get_cam_rules($level = 0)  {
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
				'field' => 'country_id',
				'label' => 'country_id',
				'rules' =>  [
					'trim',
					'required',
					'integer'
				],
				'errors' =>  [
					'integer' => 'Please select a country'
				]
			],  [
				'field' => 'region_id',
				'label' => 'region_id',
				'rules' =>  [
					'trim',
					'required',
					'integer'
				],
				'errors' =>  [
					'integer' => 'Please select a region'
				]
			]
		];

		if ($level > 0)  {
			$cam_rules[] =  [
				[
					'field' => 'state_id',
					'label' => 'state_id',
					'rules' =>  [
						'trim',
						'integer'
					],
					'errors' =>  [
					]
				],  [
					'field' => 'city',
					'label' => 'city',
					'rules' =>  [
						'trim',
						'regex_match[(w+)]'
					],
					'errors' =>  [
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
		}

		return $cam_rules;
	}

	private function get_cam_search_rules($level = 0)  {
		$cam_search_rules = [
			[
				'field' => 'country',
				'label' => 'country',
				'rules' => [
					'trim',
					'required',
					'integer',  [
						'get_country',
						[  $this->CI->activist_model, 'get_country'  ]
					]
				],
				'errors' => [
					'integer' => 'Please choose a country',
					'get_country' => 'Could not find country'
				]
			]
		];

		if ($level > 0)  {
			$cam_search_rules[] =  [
				'field' => 'state',
				'label' => 'state',
				'rules' => [
					'trim',
					'integer',  [
						'get_state',
						[  $this->CI->activist_model, 'get_state'  ]
					]
				],
				'errors' => [
					'integer' => 'Please choose a state',
					'get_state' => 'Could not find state'
				]
			];

			if ($level > 1)  {
				$cam_search_rules[] =  [
					'field' => 'city',
					'label' => 'city',
					'rules' => [
						'trim',
						'min_length[3]',
						'alpha_numeric_spaces',  [
							'require_city',
							function ($city)  {
								if (!is_null($this->CI->input->post('country')) &&
									intval($this->CI->input->post('country')) &&
									!is_null($this->CI->input->post('state')) &&
									intval($this->CI->input->post('state')))  {
									return TRUE;
								}

								return FALSE;
							}
						]
					],
					'errors' => [
						'regex_match' => 'Only use alphanumeric characters',
						'require_city' => 'Alphanumeric characters greater than length 3'
					]
				];
			}
		}

		return $cam_search_rules;
	}

	private function get_choose_pass_rules()  {
		$choose_pass_rules = [
			[
				'field' => 'passwd',
				'label' => 'passwd',
				'rules' =>  [
					'trim',
					'required',  [
						'enforce_password_strength',
						[  $this->CI->validation_callables, '_check_password_strength'  ]
					]
				],
				'errors' =>  [
				]
			],  [
				'field' => 'passwdconfirm',
				'label' => 'passwdconfirm',
				'rules' =>  [
					'trim',
					'required',
					'matches[passwd]'
				],
				'errors' =>  [
				]
			]
		];

		return $choose_pass_rules;
	}

	private function validate_form($rule, $level)
	{
		$inputs = array();
		switch ($rule)  {
			case "user":
				$inputs['email'] = $this->CI->input->post('email');
				$inputs['pass'] = password_hash($this->CI->input->post('password'), PASSWORD_DEFAULT);
				$this->CI->form_validation->set_rules($this->get_user_rules());
				break;
			case "pass":
				$this->CI->form_validation->set_rules($this->get_pass_rules());
				break;
			case "recovery":
				$this->CI->form_validation->set_rules($this->get_choose_pass_rules());
				break;
			case "auth":
				$this->CI->form_validation->set_rules($this->get_auth_rules());
				break; 
			case 'cam':
				$this->CI->form_validation->set_rules($this->get_cam_rules());
				break;
			case 'cam_search':
				$this->CI->form_validation->set_rules($this->get_cam_search_rules($level));
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

	public function validate($rule = FALSE, $level = 0)  {
                if (!$rule)  {
                	// Whoops, we don't have a page for that!
                	show_404();
		}

        	return $this->validate_form($rule, $level);
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

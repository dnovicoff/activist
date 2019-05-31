<?php
class Forms extends CI_Controller {
	private $authform = array(
		"auth",
		"user",
		"pass"
	);

	private $rules = array(
		"auth" => array(
			array(
				'field' => 'user',
				'label' => 'username',
				'rules' => 'trim|required|min_length[5]|max_length[25]',
				'errors' => array(
					'min_length' => 'Name field must be between 5 and 25 characters',
					'max_length' => 'Name field must be between 5 and 25 characters'
				)
			),
			array(
				'field' => 'pass',
				'label' => 'password',
				'rules' => 'trim|required|min_length[8]',
				'errors' => array(
					'min_length' => 'Password has minimum length of 8 characters.'
				)
			)
		),
		"user" => array(
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email|is_unique[user.user_email]',
				'errors' => array(
					'is_unique'     => 'This %s already exists.'
				)
			),
			array(
				'field' => 'confirmemail',
				'label' => 'confirmemail',
				'rules' => 'required|matches[email]|valid_email',
				'errors' => array(
				)
			),
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'trim|required|min_length[8]',
				'errors' => array(
				)
			),
			array(
				'field' => 'confirmpassword',
				'label' => 'Password Confirmation',
				'rules' => 'trim|required|matches[password]|callback_enforce_pass',
				'errors' => array(
					'required' => 'You must provide a %s.',
					'enforce_pass' => 'Password must be at least 8 alphanumeric characters with one uppercase'
				)
			)
		),
		"pass" => array(
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email|check_user',
				'errors' => array(
					'check_user' => 'does not exist.'
				)
			)
		)
	);

        function __construct()
        {
                parent::__construct();
                $this->load->model('activist_model');
                $this->load->helper('url_helper');
        }

	public function check_user($str)
	{
		if ($this->activist_model->get_user($str))  {
			return true;
		}
		return false;
	}

	public function enforce_pass($pass)
	{
		if (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/i', $pass))  {
			return TRUE;
		}
		return FALSE;
	}

	public function generate_form($tmp)
	{
		$this->load->helper('form');
    		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->rules[$tmp['data']['door']]);

		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$inputs = array(
			'email' => $this->input->post('email'),
			'pass' => $password
		);

		$this->load->view('templates/header', $tmp);
    		if ($this->form_validation->run() === FALSE)
    		{
        		$this->load->view('door/index', $tmp);

    		}
    		else
    		{
			switch ($tmp['data']['door'])  {
				case "user":
					$this->activist_model->create_user($inputs);
				case "pass":
					break;
				case "auth":
					break;
			}
        		$this->load->view('auth/index', $tmp);
		}
        	$this->load->view('templates/footer', $tmp);
	}

	public function index($form = 'auth')
        {
                if (!file_exists(APPPATH.'views/auth/index.php') && !in_array($form, $this-authforms))
		{
                	// Whoops, we don't have a page for that!
                	show_404();
		}

		$tmp = array(
			"data" => array(
        			"title" => ucfirst($form), // Capitalize the first letter
				"door" => $form
			)
		);

        	$this->generate_form($tmp);
        }
}

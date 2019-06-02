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
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|required|min_length[5]|max_length[25]|callback_check_user',
				'errors' => array(
					'min_length' => 'Name field must be between 5 and 25 characters',
					'max_length' => 'Name field must be between 5 and 25 characters',
					'check_user' => 'Email does not exist in our system'
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
				'rules' => 'required|valid_email|callback_check_user',
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

	public function check_user($email)
	{
		if ($results = $this->activist_model->get_user($email))  {
			return $results;
		}
		return FALSE;
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

		$inputs = array();
		switch ($tmp['data']['door'])  {
			case "user":
				$inputs['email'] = $this->input->post('email');
				$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$inputs['pass'] = $password;
				break;
			case "pass":
				$inputs['email'] = $this->input->post('email');
				break;
			case "auth":
				$inputs = array();
				break; 
		}

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
					$this->load->view('auth/index', $tmp);
				case "pass":
					$this->activist_model->user_password_change($inputs['email']);
					$tmp['data']['door'] = "index";
					$this->load->view('door/index', $tmp);
					break;
				case "auth":
					$this->load->view('auth/index', $tmp);
					break;
			}
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

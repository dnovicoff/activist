<?php
class Auth extends MY_Controller {

	private $rules = array(
		"auth" => array(
			array(
				'field' => 'login_string',
				'label' => 'email',
				'rules' => 'trim|required|valid_email',
				'errors' => array(
					'check_user' => 'Email does not exist in our system'
				)
			),
			array(
				'field' => 'login_pass',
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
				'rules' => 'trim|required|valid_email|is_unique[users.email]',
				'errors' => array(
					'is_unique'     => 'This %s already exists.'
				)
			),
			array(
				'field' => 'confirmemail',
				'label' => 'confirmemail',
				'rules' => 'trim|required|matches[email]|valid_email',
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
				'rules' => 'trim|required|valid_email',
				'errors' => array(
					'check_user' => 'does not exist.'
				)
			)
		)
	);

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

	public function login()
	{
		if( $this->uri->uri_string() == 'auth/login')
			show_404();

		if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )  {
			return $this->require_min_level(1);
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
				$inputs['pass'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				break;
			case "pass":
				$inputs['email'] = $this->input->post('email');
				break;
			case "auth":
				break; 
		}

    		if ($this->form_validation->run() !== FALSE)  {
			switch ($tmp['data']['door'])  {
				case "user":
					$this->activist_model->create_user($inputs);
					$this->load->view('user/index', $tmp);
					break;
				case "pass":
					$this->activist_model->user_password_change($inputs);
					$tmp['data']['door'] = "index";
					$this->load->view('door/index', $tmp);
					break;
				case "auth":
					if ($this->login())  {
						redirect('user', 'refresh');
					}
					break;
			}
		}
		$this->load->view('templates/header', $tmp);
		$this->load->view('door/index', $tmp);
        	$this->load->view('templates/footer', $tmp);
	}

	public function index($form = 'auth')
        {
                if (!file_exists(APPPATH.'views/user/index.php'))
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

	function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
        }
}

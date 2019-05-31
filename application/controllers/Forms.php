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
				'field' => 'username',
				'label' => 'username',
				'rules' => 'trim|required|min_length[5]|max_length[25]',
				'errors' => array(
					'min_length' => 'Name field must be between 5 and 25 characters',
					'max_length' => 'Name field must be between 5 and 25 characters'				
				)
			),
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
				'rules' => 'required|matches[password]',
				'errors' => array(
					'required' => 'You must provide a %s.'
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
		$this->load->helper('url');
        }

	public function check_user($str)
	{
		if ($this->activist_model->get_user($str))  {
			return true;
		}  else  {
			return false;
		}
	}

	public function generate_form($tmp)
	{
		$this->load->helper('form');
    		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->rules[$tmp['data']['door']]);

		$this->load->view('templates/header', $tmp);
    		if ($this->form_validation->run() === FALSE)
    		{
        		$this->load->view('door/index', $tmp);

    		}
    		else
    		{
        		$this->activist_model->get_user();
        		$this->load->view('auth/index', $tmp);
		}
        	$this->load->view('templates/footer', $tmp);
	}

	public function index($form = 'auth')
        {
		$parts = explode('/', uri_string());
		
                if (!file_exists(APPPATH.'views/login/index.php') && !in_array($form, $this-authforms))
		{
                	// Whoops, we don't have a page for that!
                	show_404();
		}

		$tmp = array(
			"data" => array(
        			"title" => ucfirst($form), // Capitalize the first letter
				"door" => $form,
				"method" => $parts[1]
			)
		);

        	$this->generate_form($tmp);
        }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Door extends CI_Controller
{
	private $pages = array(
		"index",
		"about",
		"user",
		"pass"
	);

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form_helper');
	}

        public function view($page = 'index')
        {
		if (!file_exists(APPPATH.'views/door/index.php') || !in_array($page, $this->pages))
		{
                	// Whoops, we don't have a page for that!
                	show_404();
		}

		$tmp = array(
			"data" => array(
        			"title" => ucfirst($page), // Capitalize the first letter
				"door" => $page
			)
		);
		
        	$this->load->view('templates/header', $tmp);
       		$this->load->view('door/index', $tmp);
        	$this->load->view('templates/footer', $tmp);
	}
}

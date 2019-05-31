<?php
class Activist_model extends CI_Model {

	public function get_activist($slug = FALSE)
	{
        	if ($slug === FALSE)
        	{
                	## $query = $this->db->get('email');
                	## return $query->result_array();
        	}
	

        	$query = $this->db->get_where('user', array('user_id' => $slug));
        	return $query->row_array();
	}

	public function get_user($email = FALSE)
	{
		if ($email !== FALSE)  {
			$query = $this->db->get_where('user', array('user_email' => $email), 1, 0);
			return $query->result_array();
		}
		return FALSE;
	}

	public function create_user($inserts)
	{
		$sql = "INSERT INTO user (user_email, user_pass, start) VALUES('".$inserts['email']."', '".$inserts['pass']."', Now())";
		$this->db->query($sql);
	}

        public function __construct()
        {
		parent::__construct();
        }
}

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
			if ($query->num_rows() > 0)  {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function user_password_change($email)
	{
		$this->email->from('root@actifish.com', 'Actifish Support');
		$this->email->to($email);
		$this->email->subject('Requested Password Change');
		$this->email->message('There will be a link here to click to change password.');
		$this->email->send();
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

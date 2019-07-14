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

	public function auth_user($email, $pass)
	{
		if (isset($email) && isset($pass))  {
			$query = $this->db->get_where('user', array('user_email' => $email), 1, 0);
			if ($query->num_rows() > 0)  {
				$result = $query->row_array();
				$auth = password_verify($pass, $result['user_pass']);
				return $auth;
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

	public function insert_campaign($cam_data)  {
		if (isset($cam_data))  {
			$this->db->set($cam_data)->insert('campaign');

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}

			return $this->db->insert_id();
		}

		return FALSE;
	}

	public function update_campaign($cam_data)  {
		if (isset($cam_data))  {
			$this->db->set('start_time', $cam_data['start_time'])
				->set('end_time', $cam_data['end_time'])
				->set('title', $cam_data['title'])
				->set('text', $cam_data['text'])
				->where('cam_id', $cam_data['cam_id'])
				->where('user_id', $cam_data['user_id'])
				->update('campaign');

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}

			if ($this->db->affected_rows() > 0)  {
				return $this->db->affected_rows();
			}
		}

		return FALSE;
	}

	public function delete_campaign($user_id, $cam_id)  {
		if (isset($user_id) && isset($cam_id))  {
			$this->db->where('user_id', $user_id)
				->where('cam_id', $cam_id)
				->delete('campaign');

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}

			if ($this->db->affected_rows() > 0)  {
				return $this->db->affected_rows();
			}
		}

		return FALSE;
	}

	public function get_campaign_data($user_id, $cam_id = NULL)  {
		if (!is_null($user_id) && !is_null($cam_id))  {
			$query = $this->db->select('*')->from('campaign')
				->where('user_id =', $user_id)
				->where('cam_id =', $cam_id)
				->order_by('cam_id', 'DESC')
				->get();

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}
			
			if ($query->num_rows() > 0)  {
				return $query->result_array();
			}
		}  else if  (!is_null($user_id))  {
			$query = $this->db->select('*')->from('campaign')
				->where('user_id =', $user_id)
				->order_by('cam_id', 'DESC')
				->get();

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}
			
			return $query->result_array();
		}

		return FALSE;
	}

	public function get_location_data($id)  {
		if (!is_null($id))  {
			$this->db->select('*')->from('location')
				->where('user_id =', $id)
				->get();

			if ($query->num_rows() > 0)  {
				return $query->result_array();
			}
		}
		return FALSE;
	}

        public function __construct()
        {
		parent::__construct();
        }
}

<?php
class Activist_model extends CI_Model {

	public function get_user($email = FALSE)  {
		if ($email !== FALSE)  {
			$query = $this->db->select('*')
				->from('user')
				->where('user_email', $email)
				->get();

			if ($query->num_rows() > 0)  {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function get_recovery_data($email = FALSE)  {
		if ($email !== FALSE)  {
			$query = $this->db->select('user_id, email, banned')
				->from('users')
				->where('email', strtolower($email))
				->limit(1)
				->get();

			if ($query->num_rows() == 1)
				return $query->row();
		}

		return FALSE;
	}

	public function get_recovery_verification_data($user_id = FALSE)  {
		if ($user_id !== FALSE)  {
			$recovery_code_expiration = date('Y-m-d H:i:s', time() - config_item('recovery_code_expiration'));

			$query = $this->db->select('username, passwd_recovery_code')
			->from('users')
			->where('user_id', $user_id)
			->where('passwd_recovery_date >', $recovery_code_expiration)
			->limit(1)
			->get();

			if ($query->num_rows() == 1)  {
				return $query->row();
			}
		}

		return FALSE;
	}

	public function update_user_raw_data($the_user, $user_data = [])  {
		$this->db->where('user_id', $the_user)
			->update('users', $user_data);

		if ($this->db->affected_rows() > 0)  {
			return TRUE;
		}

		return FALSE;
	}

	public function get_country($country_id = FALSE)  {
		if ($country_id !== FALSE)  {
			$query = $this->db->select("*")
				->from('country')
				->where('country_id', $country_id)
				->get();

			if ($query->num_rows() > 0)  {
				return TRUE;
			}
		}

		return FALSE;
	}

	public function get_state($state_id = FALSE)  {
		if ($state_id !== FALSE)  {
			$query = $this->db->select('*')
				->from('state')
				->where('state_id', $state_id)
				->get();

			if ($query->num_rows() > 0)  {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	public function user_password_change($email)
	{
		$this->email->from('root@actifish.com', 'Actifish Support');
		$this->email->to($email);
		$this->email->subject('Requested Password Change');
		$this->email->message('There will be a link here to click to change password.');
		$this->email->send();
	}
	**/

	public function get_countries()  {
		$query = $this->db->select('*')->from('country')
			->get();

		$errors = $this->db->error();
		if ($errors['code'] !== 0)  {
			return 'Error: ['.implode(", ", $this->db->error()).']';
		}
		
		if ($query->num_rows() > 0)  {	
			return $query->result_array();
		}

		return FALSE;
	}

	public function get_states($country_id)  {
		$query = $this->db->select('*')->from('state')
			->where('country_id', $country_id)
			->get();

		$errors = $this->db->error();
		if ($errors['code'] !== 0)  {
			return 'Error: ['.implode(", ", $this->db->error()).']';
		}
		
		if ($query->num_rows() > 0)  {	
			return $query->result_array();
		}

		return FALSE;
	}

	public function get_cities($country_id = NULL, $state_id = NULL)  {
		$query = $this->db->select('*')->from('state')
			->where('country_id', $country_id)
			->get();

		$errors = $this->db->error();
		if ($errors['code'] !== 0)  {
			return 'Error: ['.implode(", ", $this->db->error()).']';
		}
		
		if ($query->num_rows() > 0)  {	
			return $query->result_array();
		}

		return FALSE;
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

	public function get_campaigns($country_id = NULL, $state_id = NULL, $city_id = NULL)  {

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

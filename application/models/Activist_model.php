<?php
class Activist_model extends CI_Model {

	public function get_user($email = FALSE)  {
		if ($email !== FALSE)  {
			$query = $this->db->select('*')
				->from('users')
				->where('email', $email)
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

	public function get_regions()  {
		$query = $this->db->select("*")->from('region')
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

	public function verify_state($sid = FALSE, $rid = FALSE, $cid = FALSE)  {
		$count = 0;
		if ($sid !== FALSE && $rid !== FALSE && $cid !== FALSE)  {
			$query = $this->db->select('*')
				->from('region')
				->where('region_id', $rid)
				->where('region_name', 'State')
				->get();

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';;
			}

			if ($query->num_rows() === 0)  {
				$query = $this->db->select('*')
					->from('region')
					->where('region_id', $rid)
					->where('region_name', 'City')
					->get();

				$errors = $this->db->error();
				if ($errors['code'] !== 0)  {
					return 'Error: ['.implode(", ", $this->db->error()).']';;
				}

				if ($query->num_rows() > 0)  {
					$count = $query->num_rows();
				}
			}  else  {
				$count = $query->num_rows();
			}

			if ($count > 0)  {
				$query = $this->db->select('*')
					->from('country')
					->join('state', 'country.country_id = state.country_id')
					->where('country.country_id', $cid)
					->where('state.state_id', $sid)
					->get();

				$errors = $this->db->error();
				if ($errors['code'] !== 0)  {
					return 'Error: ['.implode(", ", $this->db->error()).']';
				}

				if ($query->num_rows() > 0)  {
					return TRUE;
				}  else  {
					return 'Error: your chosen state was not found within your country';
				}
			}  else  {
				return 'Error: your region choice does not match the rest of the form';
			}
		}

		return FALSE;
	}

	public function verify_city($cid = FALSE, $rid = FALSE, $sid = FALSE, $city = FALSE)  {
		if ($cid !== FALSE && $rid !== FALSE && $sid !== FALSE && $city !== FALSE)  {
			$query = $this->db->select('*')
				->from('region')
				->where('region_id', $rid)
				->where('region_name', 'City')
				->get();

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';;
			}

			if ($query->num_rows() > 0)  {
				$query = $this->db->select('*')
					->from('city')
					->join('city_state', 'city.city_id = city_state.city_id')
					->join('state', 'city_state.state_id = state.state_id')
					->join('country', 'state.country_id = country.country_id')
					->where('country.country_id', $cid)
					->where('state.state_id', $sid)
					->like('city', $city)
					->get();

				$errors = $this->db->error();
				if ($errors['code'] !== 0)  {
					return 'Error: ['.implode(", ", $this->db->error()).']';
				}

				if ($query->num_rows() > 0)  {
					return TRUE;
				}  else  {
					return 'Error: your chosen city was not found within your state';
				}
					
			}  else  {
				return 'Error: you chose a city but did not choose a city for your region';
			}
		}

		return FALSE;
	}

	public function get_city($state_id = NULL, $city_id = NULL)  {
		if (is_numeric($state_id) && is_numeric($city_id))  {
			$query = $this->db->select('*')->from('city')
				->join('city_state', 'city_state.city_id = city.city_id')
				->where('city_state.state_id', $state_id)
				->where('city.city_id', $city_id)
				->get();

			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}
		
			if ($query->num_rows() > 0)  {	
				return $query->result_array();
			}
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

	public function delete_campaign($user_id = FALSE, $cam_id = FALSE)  {
		if (is_numeric($user_id) && is_numeric($cam_id))  {
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

	public function get_campaign_data($user_id = NULL, $cam_id = NULL)  {
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
		}  else if  (!is_null($user_id) && is_numeric($user_id))  {
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

	public function insert_user($user = FALSE)  {
		if ($user !== FALSE)  {
			$this->db->set($user)
				->insert('users');
			
			$errors = $this->db->error();
			if ($errors['code'] !== 0)  {
				return 'Error: ['.implode(", ", $this->db->error()).']';
			}

			return $this->db->insert_id();
		}

		return FALSE;
	}

	public function get_unused_id()  {
		$random_unique_int = 2147483648 + mt_rand( -2147482448, 2147483647 );

		$query = $this->db->where( 'user_id', $random_unique_int)
			->get_where('users');

		if ($query->num_rows() > 0)  {
			$query->free_result();
			return $this->get_unused_id();
		}

		return $random_unique_int;
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

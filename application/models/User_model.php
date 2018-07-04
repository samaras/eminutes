<?php
class User_Model extends CI_Model {
    /**
    * Validate the login's data with the database
    *
    * @return boolean
    */
	function validate()
	{
		// grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

		// Load bcrypt library
		$this->load->library('bcrypt');

		$this->db->select('id, username, password, email, first_name, last_name');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query -> num_rows() == 1)
		{
			$objUser = $query->result()[0];

			if ($this->bcrypt->check_password($password, $objUser->password))
			{
			    // Password does match stored password.
				//update the last login time
				$last_login = date("Y-m-d H-i-s");

				$data = array(
				 "last_login" => $last_login
				);

				$this->db->update("users", $data);

				//store user id in the session
				//$CI->session->set_userdata("user_id", $query->row()->ID);
				$arrUser = json_decode(json_encode($objUser), true);

			    $this->session->set_userdata($arrUser); //set the session 
			    return true;
			}
			else
			{
			    // Password does not match stored password.
			    return false;
			}
		}
		else
		{
			return false;
		}
	}
    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$user = $this->authex->get_userdata();
		return $user;
	}

	/**
	 * Get the user by his email
	 *
     * @param string $email
     * @return boolean
     */
	function get_user_by_email($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		return $query->result();
	}

	/**
	 *
	 * TODO: function naming convention
	 */
	function getEmailList($keyword)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->like('email', $keyword);
		
		$arrList = $this->db->get()->result_array();
	
		$emailList = [];
		foreach ($arrList as $key => $value) {
			$emailList[] = $value;
		}

		return $emailList;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{
		// Load encryption library
		$this->load->library('bcrypt');
		
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('users');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{
			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),			
				'username' => $this->input->post('username'),
				'phone' => $this->input->post('phone'),
				'password' => $hash = $this->bcrypt->hash_password($this->input->post('password'))						
			);
			$insert = $this->db->insert('users', $new_member_insert_data);

			// add user to the membership table
			$uid = $this->db->insert_id();

			$data = array(
			   'user_id' => $uid,
			   'group_id' => 1, // all new user are just regular memebers
			);

			$this->db->insert('membership', $data);

			// add the user to the regular group
		    return $insert;
		}
	      
	}//create_member
}

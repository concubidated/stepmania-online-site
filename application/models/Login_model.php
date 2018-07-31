<?php
class Login_model extends CI_Model {


	public function __construct(){
		
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('string');
	}


	public function is_logged(){
		if($this->session->userdata('logged_in'))
			return true;
	}


	public function check_login() {
		$username = $this->db->escape($this->input->post('username'));
		$password = $this->input->post('pass1'); 

		//Check if using magento password or garage password.
		$query = $this->db->query("SELECT ID, Username, email, password from users where `Username`=$username");

		if($query->num_rows() == 1){
			$result = $query->first_row();
			if(!empty($result->password)){
				$hash = $result->password;
				$userdata['id'] = $result->ID;
				$userdata['name'] = $result->Username;
				$userdata['email'] = $result->email;
                        	$password_hash = md5($password);

				if (strcasecmp($password_hash,$hash) == 0)
				{

					//Set session data, and cookie data
					$this->session->set_userdata($userdata);
					$this->session->set_userdata('logged_in', 'true');
					
					//For remember me
					$remember = random_string('alnum', 16);
					$random = array("string" => $remember, "id" => $userdata['id']);
					$cookie['value'] = serialize($random);
					//$cookie['value'] = serialize($userdata);
					$cookie['expire'] = 31536000;
					$cookie['name'] = 'smo';

					$this->input->set_cookie($cookie['name'], $cookie['value'], $cookie['expire']);
					//Check local db and store customer info
					return 1;
				}
			}
			return 0;
		}
		else {
			return 0;
		}
	}//End check_login

	public function update_login() {
                $id = $this->db->escape($this->session->userdata('id'));
		if (!empty($this->input->post('username'))) {
			$username = $this->db->escape($this->input->post('username'));

			//If Username is being updated, check to make sure it is not in use.
			if ($this->input->post('username') != $this->session->userdata('name')){
				$query = $this->db->query("SELECT ID from users where `Username`=$username");
				if($query->num_rows() == 1){
					return "Username Already In Use";
				} else {
					$query = $this->db->query("UPDATE users set `Username`=$username WHERE `ID`=$id");
				}
			}
		}

		if (!empty($this->input->post('pass1'))){
			$pass1 = $this->db->escape(md5($this->input->post('pass1')));
                	$pass2 = $this->db->escape(md5($this->input->post('pass2')));
			if (strcasecmp($pass1, $pass2) == 0){
				$query = $this->db->query("UPDATE users set `password`=$pass1 where `ID`=$id");
			} else {
				return "Passwords do not match";
			}
			return 1;
		}
		if (!empty($this->input->post('email'))){
		        if ($this->input->post('email') != $this->session->userdata('email')){
				$email = $this->db->escape($this->input->post('email'));
                                $query = $this->db->query("SELECT ID from users where `email`=$email");
                                if($query->num_rows() == 1) return "Email already in Use";
                                else $query = $this->db->query("UPDATE users set `email`=$email WHERE `ID`=$id");
				$email = $this->input->post('email');
				$this->session->set_userdata('email', $email);                	

			}
		}
	}



}

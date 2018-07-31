<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	


	public function index()
	{
		$data['title'] = "Stepmania Online";	

		$this->load->helper('form');
                $this->load->library('form_validation');
		$this->load->model('login_model');


		if($this->login_model->is_logged()){


		} else redirect('/');




		$this->load->view('templates/header', $data);

		$this->load->view('user', $data);

		$this->load->view('templates/footer', $data);


	}


	public function manage()
	{
		$data['title'] = "Stepmania Online";

                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->model('login_model');


                if($this->login_model->is_logged()){


			$data['username'] = $this->session->userdata('name');
			$data['email'] = $this->session->userdata('email');


			$this->form_validation->set_rules('username', 'Username');
			$this->form_validation->set_rules('pass1', 'Password', 'trim|min_length[6]');
			$this->form_validation->set_rules('pass2', 'Password Confirmation', 'trim|matches[pass1]');
			$this->form_validation->set_rules('email', 'Email');
			$data['auth'] = 1;

			if ($this->form_validation->run() == FALSE)
				$data['auth'] = 1;
			else {
				$ret = $this->login_model->update_login(); 
				if ($ret!=1)
					$data['auth'] = $ret;
			}


			//Edit Password

			//Update Email Address

			$this->load->view('templates/header', $data);
                	$this->load->view('user', $data);
                	$this->load->view('templates/footer', $data);


                } else redirect('/');




	}
}

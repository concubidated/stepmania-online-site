<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	


	public function index()
	{
		$data['title'] = "Stepmania Online";	

		$this->load->helper('form');
                $this->load->library('form_validation');
		$this->load->model('login_model');


		if($this->login_model->is_logged()){


		} else {

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('pass1', 'Password', 'required');
		$data['auth'] = TRUE;

		if ($this->form_validation->run() === FALSE) $data['auth'] = TRUE;
		elseif (!$this->login_model->check_login()) $data['auth'] = FALSE;
		else redirect('/');
		}






		//Get News
		$data['news'] = $this->db_model->GetNews();

		$this->load->view('templates/header', $data);

		$this->load->view('home', $data);

		$this->load->view('templates/footer', $data);


	}
}

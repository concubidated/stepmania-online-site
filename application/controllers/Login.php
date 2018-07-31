<?php 
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		if ($this->input->post('logout') == "Logout"){
			$this->session->sess_destroy();
			delete_cookie("smo");
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		if($this->session->userdata('id') == 2)
			$this->output->enable_profiler(TRUE);

	}


	public function index($function = FALSE)
	{

		if ($function == "logout"){
			$this->session->sess_destroy();
			delete_cookie("smo");
			redirect('/');
		}

		if($this->login_model->is_logged())
			redirect('/profile');
		else {
			$cookie = get_cookie('smo', TRUE);
			if ($cookie) {
				$string = unserialize($cookie);
				if ($this->db_model->cookieCheck($string['string'],$string['id'])){
					$this->session->set_userdata($string);
					$this->session->set_userdata('logged_in', 'true');
					redirect('/profile');
				} 
			} 
		}

		$data['title'] = 'Sign In';
		$data['page'] = "login";

		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('pass1', 'Password', 'required');
			
		$data['auth'] = TRUE;

		if ($this->form_validation->run() === FALSE)
		{
			$data['auth'] = TRUE;
		} elseif (!$this->login_model->check_login()){
			$data['auth'] = FALSE;
		} else {
			redirect('/profile');
		}
		
		$this->load->view('/templates/header', $data);
		$this->load->view('/login/index', $data);
		$this->load->view('/templates/footer', $data);
	}

	public function signup() {
		$data['title'] = 'Create Account';
		$data['errors'] = "";

		if($this->login_model->is_logged())
			redirect('/user/manage');

		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('pass1', 'Password', 'required');
		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');

		if ($this->form_validation->run()){
			$result = $this->login_model->create_user();
			if(!is_numeric($result))
				$data['errors'] = $result;
			else {
				if($this->login_model->check_login())
					redirect('/user/manage');
				else
					redirect('/login');
			}
		}


		$this->load->view('templates/header', $data);
		$this->load->view('/login/signup', $data);
		$this->load->view('/templates/footer');

}

}

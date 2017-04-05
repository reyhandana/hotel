<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('bcrypt');
		$this->load->model('m_auth');
	}

	// redirect if needed, otherwise display the user list
	public function index()
	{
		redirect('auth/login');
	}

	public function login(){
		if($this->session->userdata('logged_in')){
			redirect('/', 'refresh');
		}
		var_dump($this->bcrypt->hash_password('12345'));
		// validasi input
		$this->form_validation->set_rules('identity', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === TRUE)
		{
			// input post
			$identity = $this->input->post('identity');
			$password = $this->input->post('password');

			// jika login berhasil, redirect ke halaman dashboard
			if ($this->m_auth->check_login($identity, $password))
			{
				redirect('/');
			}
			else
			{
				$this->session->set_flashdata('action_status', '<div class="alert alert-danger">Username atau password Anda salah</div>');
				redirect('auth/login', 'refresh');		
			}
		}
		else
		{
			$data = array(
				'title'	=> 'Login'
				);
			$this->load->view('templates/login', $data);
		}
	}

	// log the user out
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$this->session->sess_destroy();

		// redirect them to the login page
		$this->session->set_flashdata('action_status', '<div class="alert alert-info">Anda telah keluar sistem</div>');
		redirect('auth/login', 'refresh');
	}

}
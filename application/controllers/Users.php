<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->model('m_users');
	}

	function index(){
		$data = array(
			'title' => 'Users',
			'table' => $this->m_users->get()->result()
			);
		$this->template->load('admin', 'users/users', $data);
	}

	function add(){
		$data = array(
			'title' => 'Tambah User',
			'role' => array_column($this->m_users->get_group()->result_array(), 'nama', 'id')
			);
		$params = array(
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'id_group' => $this->input->post('role'),
			'password' => $this->input->post('password')
			);
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm-password', 'Konfirmasi Password', 'required|min_length[6]|matches[password]');
		if($this->form_validation->run()){
			$query = $this->m_users->add($params);
			if( $query === TRUE) {
				$this->session->set_flashdata('action_status', '<div class="alert alert-success" data-dismiss="alert">Data berhasil ditambah</div>');
			} else {
				$this->session->set_flashdata('action_status', '<div class="alert alert-danger" data-dismiss="alert">Data gagal ditambah</div>');			
			}
			redirect('users', 'refresh');
		}
		else{
			$this->template->load('admin', 'users/add', $data);
		}
	}

	function edit($id){
		$data_edit = $this->m_users->get($id)->row();
		$data = array(
			'title' => 'Edit User',
			'role' => array_column($this->m_users->get_group()->result_array(), 'nama', 'id'),
			'data_edit' => $data_edit
			);
		$params = array(
			'id' => $id,
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'id_group' => $this->input->post('role'),
			'password' => $this->input->post('password')
			);
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]');
		$this->form_validation->set_rules('confirm-password', 'Konfirmasi Password', 'min_length[6]|matches[password]');
		if ($this->input->post('email') != $data_edit->email) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		}
		else{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		}
		if($this->form_validation->run()){
			$query = $this->m_users->edit($params);
			if( $query === TRUE) {
				$this->session->set_flashdata('action_status', '<div class="alert alert-success" data-dismiss="alert">Data berhasil diubah</div>');
			} else {
				$this->session->set_flashdata('action_status', '<div class="alert alert-danger" data-dismiss="alert">Data gagal diubah</div>');			
			}
			redirect('users', 'refresh');
		}
		else{
			$this->template->load('admin', 'users/edit', $data);
		}
	}

	function delete($id){
		$this->m_users->delete($id);
		redirect('users', 'refresh');
	}

	function hasing(){
		$this->load->library('bcrypt');
		$chiper = 'mypassword';
		$salt = '465sdf89s7g8';
		$hash1 = $this->bcrypt->hash_password($chiper);
		$hash2 = $this->bcrypt->hash_password($salt.$chiper);
		var_dump($hash1);
		var_dump($hash2);
	}


}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->library('bcrypt');
	}

	public function get($id=NULL){
		$this->db->select('u.id, u.nama, u.email, g.nama as role')
		->from('users u')
		->join('users_groups ug', 'u.id=ug.id_user')
		->join('groups g', 'g.id=ug.id_group');
		if($id!== NULL){
			$this->db->where('u.id', $id);
		}
		$this->db->order_by('u.nama');
		$query = $this->db->get();
		return $query;
	}

	public function get_group($id=NULL){
		if($id!== NULL){
			$this->db->where('id', $id);
		}
		$this->db->order_by('nama');
		$query = $this->db->get('groups');
		return $query;
	}

	public function get_by_email($email){
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		return $query;
	}

	public function add($data){
		$data_user =  array(
			'nama' => $data['nama'],
			'email' => $data['email'],
			'password' => $this->bcrypt->hash_password($data['password'])
			);
		$query1 = $this->db->insert('users', $data_user);
		$find = $this->get_by_email($data['email'])->row();
		$id = $find->id;
		$data_group = array(
			'id_user' => $id,
			'id_group' => $data['id_group']
			);
		$query2 = $this->add_to_group($data_group);
		if($query1 && $query2){
			$query = TRUE;
		}
		else{
			$query = FALSE;
		}
		return $query;
	}
	public function add_to_group($data){
		$data_group = array(
			'id_user' => $data['id_user'],
			'id_group' => $data['id_group']
			);
		$query = $this->db->insert('users_groups', $data_group);
		return $query;
	}

	public function edit($data){
		$data_user =  array(
			'nama' => $data['nama'],
			'email' => $data['email']
			);
		if($data['password']!==NULL){
			$data_user['password'] = $this->bcrypt->hash_password($data['password']);
		}
		$this->db->where('id', $data['id']);
		$query1 = $this->db->update('users', $data_user);
		$data_group = array(
			'id_group' => $data['id_group']
			);
		$this->db->where('id_user', $data['id']);
		$query2 = $this->db->update('users_groups', $data_group);
		if($query1 && $query2){
			$query = TRUE;
		}
		else{
			$query = FALSE;
		}
		return $query;
	}

	public function delete($id){
		$query = $this->db->where('id', $id)
		->delete('users');
		return $query;
	}
}
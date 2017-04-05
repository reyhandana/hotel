<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_provinsi extends CI_Model{

	public function get($id=NULL){
		if($id!== NULL){
			$this->db->where('id', $id);
		}
		$this->db->order_by('nama');
		$query = $this->db->get('provinsi');
		return $query;
	}

	public function add($data){
		$query = $this->db->insert('provinsi', $data);
		return $query;
	}

	public function edit($data){
		$query = $this->db->where('id', $data['id'])
			->update('provinsi', $data);
		return $query;
	}

	public function delete($id){
		$query = $this->db->where('id', $id)
			->delete('provinsi');
		return $query;
	}
}
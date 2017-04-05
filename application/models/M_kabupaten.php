<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class M_kabupaten extends CI_Model
{
	
	public function __construct(){
		parent::__construct();
	}

	public function get($id=NULL){
		$this->db->select('k.id as id_kab, k.nama as kab, k.jumlah_penduduk, p.id as id_prov, p.nama as prov')
			->from('kabupaten k')
			->join('provinsi p', 'p.id=k.id_provinsi');
		if($id!== NULL){
			$this->db->where('k.id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function filter_per_prov($id_prov=NULL){
		$this->db->select('k.id as id_kab, k.nama as kab, k.jumlah_penduduk, p.id as id_prov, p.nama as prov')
			->from('kabupaten k')
			->join('provinsi p', 'p.id=k.id_provinsi');
		if($id_prov!== NULL){
			$this->db->where('p.id', $id_prov);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($data){
		$query = $this->db->insert('kabupaten', $data);
		return $query;
	}

	public function edit($data){
		$query = $this->db->where('id', $data['id'])
			->update('kabupaten', $data);
		return $query;
	}

	public function delete($id){
		$query = $this->db->where('id', $id)
			->delete('kabupaten');
		return $query;
	}


}
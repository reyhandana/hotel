<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_wisman extends CI_Model{

	public function get($id=NULL){
		$this->db->select('a.nama, ');
        if($id!== NULL){
			$this->db->where('id', $id);
		}
		$this->db->order_by('nama');
		$query = $this->db->get('wisman');
		return $query;
	}

	public function edit($data){
        $data_input = $data['data_input'];
        $bulan = $data['bulan'];
        $tahun = $data['tahun'];
        $id_user = $this->session->getuserdata('id');
        foreach ($jumlah as $key => $value) {
            $find_stat = $this->find_stat($id_user, $key, $bulan, $tahun)->result();
            if($find_stat!= NULL){
                $data = array(
                    'id' => $key,
                    'jumlah_check_in' => $value['jumlah_check_in'],
                    'lama_tinggal' => $value['lama_tinggal']
                );
                $this->db->where('id', $key)
                ->update('statistik_wisatawan', $data);
            }
            else{
                $data = array(
                    'id' => $key,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'jumlah_check_in' => $value['jumlah_check_in'],
                    'lama_tinggal' => $value['lama_tinggal']
                );
                $this->db->insert('statistik_wisatawan', $data);
            }
        }
	}

    private function find_stat($id_user, $id_asal, $bulan, $tahun){
        $this->db->where('id_user', $id_user)
            ->where('id_asal', $id_asal)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun);
        $query = $this->db->get();
        return $query;        
    }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_statistik extends CI_Model{

	public function get_statistik($id_user){
		$survei = $this->get_tanggal_survei($id_user)->result();
        $data = array();
        foreach($survei as $val){
            $wisman = $this->get_total_wisatawan($val->id, $id_user, 1)->row_array();
            $wisnus = $this->get_total_wisatawan($val->id, $id_user, 2)->row_array();
            $penjualan = $this->get_penjualan($val->id)->row_array();
            $monthNum  = $val->bulan;
            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
            $data[] = array(
                'id_survei' => $val->id,
                'tahun' => $val->tahun,
                'bulan' => $monthName,
                'wisman_check_in' => $wisman['jumlah_check_in'] !== NULL ? $wisman['jumlah_check_in'] : 0,
                'wisman_lama_tinggal' => $wisman['lama_tinggal'] !== NULL ? $wisman['lama_tinggal'] : 0,
                'wisnus_check_in' => $wisnus['jumlah_check_in'] !== NULL ? $wisnus['jumlah_check_in'] : 0,
                'wisnus_lama_tinggal' => $wisnus['lama_tinggal'] !== NULL ? $wisnus['lama_tinggal'] : 0,
                'kamar_terjual' => $penjualan['kamar_terjual'] !== NULL ? $penjualan['kamar_terjual'] : 0,
                'bed_terjual' => $penjualan['bed_terjual'] !== NULL ? $penjualan['bed_terjual'] : 0
            );
        }
        return $data;
	}

    public function get_total_wisatawan($id_survei, $id_user, $id_jenis=NULL){
        $this->db->select_sum('sw.jumlah_check_in')
            ->select_avg('sw.lama_tinggal')
        // $this->db->select('SUM("sw.jumlah_check_in"), AVG("sw.lama_tinggal")')
            ->from('statistik_wisatawan sw');
            // ->join('survei s', 's.id=sw.id_survei')
        if($id_jenis!==NULL){
            $this->db->join('asal_wisatawan aw', 'aw.id=sw.id_asal')
                ->where('aw.id_jenis', $id_jenis);
        }
        $this->db->where('sw.id_survei', $id_survei);        
        $query = $this->db->get();
        return $query;
    }

    public function get_penjualan($id_survei){
        $this->db->where('id_survei', $id_survei);
        $query = $this->db->get('statistik_penjualan');
        return $query;
    }

    public function get_tanggal_survei($id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('survei');
        return $query;        
    }

    public function statistik_wisatawan($id_survei, $id_jenis){
        $this->db->select('sw.id_asal, aw.nama, sw.jumlah_check_in, sw.lama_tinggal')
            ->from('statistik_wisatawan sw')
            ->join('asal_wisatawan aw', 'aw.id=sw.id_asal')
            ->where('sw.id_survei', $id_survei)
            ->where('aw.id_jenis', $id_jenis);
        $query = $this->db->get();
        return $query;
    }

    public function get_asal_wisatawan($id_jenis, $id_asal=NULL){
        if($id_asal!==NULL){
            $this->db->where('id', $id_asal);
        }
        $this->db->where('id_jenis', $id_jenis);
        $query = $this->db->get('asal_wisatawan');
        return $query;
    }

    function get_survei($id=NULL){
        if($id===NULL){
            $this->db->where('id', $id);
        }
        $query = $this->db->get('survei');
        return $query;
    }

    function get_statistik_penjualan($id_survei, $id_penjualan=NULL){
        if($id_penjualan!==NULL){
            $this->db->where('id', $id);
        }
        $this->db->where('id_survei', $id_survei);
        $query = $this->db->get('statistik_penjualan');
        return $query;
    }

    function get_stok_penjualan($id_user){
        $this->db->select('jml_kamar, jml_bed')
            ->where('id', $id_user);
        $query = $this->db->get('users');
        return $query;
    }
}
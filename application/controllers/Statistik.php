<?php defined('BASEPATH') OR exit('No direct script access allowed');

class statistik extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library(array('template', 'session'));
		$this->load->model(array('m_statistik', 'm_wisman'));
		// $tpl = new MY_Controller();
	}

	function index(){
		$id_user = $this->session->userdata('id');
		// var_dump( $this->session->userdata());
		$data = array(
			'title' => 'statistik',
			'table' => $this->m_statistik->get_statistik($id_user)
			);
		// $tpl = new MY_Controller();
		// $this->template->load($tpl->get_template, 'statistik/index', $data);
		$this->template->load('admin', 'statistik/index', $data);
	}

	function add(){
		$id_user = $this->session->userdata('id');
		$wisman = $this->m_statistik->get_asal_wisatawan(1)->result_array();
		$wisnus = $this->m_statistik->get_asal_wisatawan(2)->result_array();
		$tamu = $this->m_statistik->get_stok_penjualan($id_user)->row_array();
		$data = array(
			'title' => 'tambah statistik',
			'wisman' => $wisman,
			'wisnus' => $wisnus,
			'tamu' => $tamu
		);
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|max_length[4]');
		$this->form_validation->set_rules('bulan', 'Bulan', 'required');
		$this->form_validation->set_rules('pembuat', 'Pembuat', 'required|max_length[50]');
		foreach ($wisman as $row) {
        	$this->form_validation->set_rules('jumlah[' . $row['id'] . ']', 'Jumlah (Check In)', 'trim|is_natural');
        }
		foreach ($wisnus as $row) {
            $this->form_validation->set_rules('lama[' . $row['id'] . ']', 'Lama Tinggal', 'trim|is_natural');
        }
		$this->form_validation->set_rules('kamar_terjual', 'Jumlah Kamar Terjual', 'trim|is_natural');
		$this->form_validation->set_rules('bed_terjual', 'Jumlah Bed Terjual', 'trim|is_natural');

		if($this->form_validation->run()){
			
		}else{
			$this->template->load('admin', 'statistik/add', $data);	
		}	
		
	}

	function detail($id_survei){
		$id_user = $this->session->userdata('id');
		$tanggal = $this->m_statistik->get_survei($id_survei)->row_array();
		$bulan = date('F', mktime(0, 0, 0, $tanggal['bulan'], 10));
		$tahun = $tanggal['tahun'];
		$terjual = $this->m_statistik->get_statistik_penjualan($id_survei)->row_array();
		$data = array(
			'title' => 'Detail Statistik',
			'nama_hotel' => $this->session->userdata('nama'),
			'bulan' => $bulan,
			'tahun' => $tahun,
			'wisman' => $this->m_statistik->statistik_wisatawan($id_survei, 1)->result_array(),
			'wisnus' => $this->m_statistik->statistik_wisatawan($id_survei, 2)->result(),
			'tamu' => $this->m_statistik->get_stok_penjualan($id_user)->row_array(),
			'terjual' => $terjual !== NULL ? $terjual : 0
			);var_dump($data);
		$this->template->load('admin', 'statistik/detail', $data);
	}


	function edit(){
		$data_edit = $this->m_statistik->get()->result();
		$data = array(
			'title' => 'Input Data Statistik statistik',
			'data_edit' => $data_edit
			);
		$params = array(
			// 'jumlah_check_in' => $this->input->post('jumlah-check-in'),
            // 'lama_tinggal' => $this->input->post('lama-tinggal')
            'data_input' => $this->input->post('data-input'),
            'bulan' => $this->input->post('bulan'),
            'tahun' => $this->input->post('tahun'),
			);
        foreach ($data['data_edit'] as $row) {
            // $this->form_validation->set_rules('jumlah-check-in[' . $row['id'] . ']', 'Jumlah (Check In)', 'trim|numeric|greater_than_equal_to[0]');
            // $this->form_validation->set_rules('lama-tinggal[' . $row['id'] . ']', 'Lama Tinggal', 'trim|numeric|greater_than_equal_to[0]');
            $this->form_validation->set_rules('data-input[jumlah_check_in][' . $row['id'] . ']', 'Jumlah (Check In)', 'trim|numeric|greater_than_equal_to[0]');
            $this->form_validation->set_rules('data-input[lama_tinggal][' . $row['id'] . ']', 'Lama Tinggal', 'trim|numeric|greater_than_equal_to[0]');
        }


	
		if($this->form_validation->run()){
			$query = $this->m_statistik->edit($params);
			// if( $query === TRUE) {
			// 	$this->session->set_flashdata('action_status', '<div class="alert alert-success" data-dismiss="alert">Data berhasil diubah</div>');
			// } else {
			// 	$this->session->set_flashdata('action_status', '<div class="alert alert-danger" data-dismiss="alert">Data gagal diubah</div>');			
			// }
			redirect('statistik', 'refresh');
		}
		else{
			$this->template->load('admin', 'statistik/edit', $data);
		}
	}

}
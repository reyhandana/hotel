<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wisman extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->model('m_wisman');
		$tpl = new MY_Controller();
	}

	function index(){
		$data = array(
			'title' => 'Wisman',
			'table' => $this->m_wisman->get()->result()
			);
		$this->template->load($tpl->get_template, 'wisman/wisman', $data);
	}


	function edit(){
		$data_edit = $this->m_wisman->get()->result();
		$data = array(
			'title' => 'Input Data Statistik Wisman',
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
			$query = $this->m_wisman->edit($params);
			if( $query === TRUE) {
				$this->session->set_flashdata('action_status', '<div class="alert alert-success" data-dismiss="alert">Data berhasil diubah</div>');
			} else {
				$this->session->set_flashdata('action_status', '<div class="alert alert-danger" data-dismiss="alert">Data gagal diubah</div>');			
			}
			redirect('wisman', 'refresh');
		}
		else{
			$this->template->load('admin', 'wisman/edit', $data);
		}
	}

}
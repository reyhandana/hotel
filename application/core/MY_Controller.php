<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $template;

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if(!$this->session->userdata('logged_in')){
			redirect('auth', 'refresh');
		}
	}

	function get_template(){
		if($this->session->userdata('role')==1){
			$template = 'admin';
		}else{
			$template = 'user';
		}
		return $template;
		// return 'admin';
	}
}
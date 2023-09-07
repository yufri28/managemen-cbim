<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('kode_role')) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['dataMenu'] = $this->get_menu();
		$this->load->view('./templates/header', $data);
		$this->load->view('home');
		$this->load->view('./templates/footer');
	}

	public function get_menu(){
		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN auth a ON mn.f_id_auth=a.id_auth JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE a.id_auth=1;")->result_array();
		return $data;
	}

}
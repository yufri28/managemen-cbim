<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $id_role;
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('kode_role')) {
			redirect(base_url('auth'));
		}

		$this->id_role = $this->session->userdata('id_role');
	}

	public function index()
	{
		$data['jumlah_notif'] = $this->m_data->count_notification();
		$data['dataNotif'] = $this->m_data->get_notification();
		$data['dataMenu'] = $this->get_menu($this->id_role);
		$this->load->view('./templates/header', $data);
		$this->load->view('home');
		$this->load->view('./templates/footer');
	}

	public function get_menu($id_role=null){

		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN role r ON mn.f_id_role=r.id_role JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE r.id_role='$id_role';")->result_array();
		return $data;
	}
	
	public function count_notifications(){
        $data = $this->m_data->count_notification();
		$dataNotif = $this->m_data->get_notification();
		$result['jumlah_notifikasi'] = $data;
		$result['dataNotif'] = $dataNotif;
		echo json_encode($result);
    }


}
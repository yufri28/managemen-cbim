<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if($this->cek_default_admin() == false){
			$this->add_default_admin();
		}
		if($this->session->userdata('kode_role')) {
			redirect(base_url('home'));
		}

		// echo $this->session->userdata('kode_role');

	}
	public function index()
	{
		$this->load->view('auth/login');
	}

	public function login(){
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$user = $this->db->get_where('auth', ['username' => $username])->row_array();
		$kode_role = $this->db->get_where('role', ['id_role' => $user['f_id_role']])->row_array();
		if(!empty($user['id_auth'])){
			if(password_verify($password,$user['password'])){
				$data_session = array(
					'id_auth'	=> $user['id_auth'],
					'username'	=> $user['username'],
					'id_role'  => $kode_role['id_role'],
					'kode_role'	=> $kode_role['kode_role']
				);
				$this->session->set_userdata($data_session);
				// $this->session->set_flashdata('message', '<div class="alert alert-success alert-message text-center"><b>Login Berhasil !,<br></b> Halaman ini akan dialihkan ke Halaman Home</div>');
				redirect(base_url('home'));
			}else{
				$this->session->set_flashdata('message', '<h5 class="text-danger">Login gagal!</h5>');
				redirect(base_url('auth'));
			}
		}else{
			$this->session->set_flashdata('message', '<h5 class="text-danger">Login gagal!</h5>');
			redirect(base_url('auth'));
		}
		
	}

	private function add_default_role(){
		$data = array(
			'id_role' => 0,
			'role' => 'Admin',
			'kode_role' => 0,
		);
		$this->db->insert('role', $data);
	}

	private function get_default_role(){
		$id = null;
		$get_data = $this->db->query("SELECT id_role FROM role WHERE kode_role=0")->row_array();
		foreach ($get_data as $key => $data) {
			$id = $data['id_role'];
		}
		return $id;
	}

	private function cek_default_role(){

		$get_data = $this->db->query("SELECT id_role FROM role WHERE kode_role=0")->num_rows();
		if($get_data > 0){
			return true;
		}else{
			return false;
		}
	} 

	private function add_default_admin(){
		if($this->cek_default_role() == false){
			$this->add_default_role();
		}elseif($this->cek_default_role() == true){
			$id_role = $this->get_default_role();
			$data = array(
				'id_auth' => 0,
				'id_pengguna' => null,
				'username' => 'admin',
				'password' => password_hash("admin123", PASSWORD_DEFAULT),
				'f_id_role' => $id_role
			);
			$this->db->insert('auth', $data);
		}
	} 


	private function cek_default_admin(){

		$get_data = $this->db->query("SELECT username FROM auth WHERE username='admin'")->num_rows();
		if($get_data > 0){
			return true;
		}else{
			return false;
		}
	} 


	
}
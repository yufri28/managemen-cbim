<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_add extends CI_Controller {

	public function index()
	{
        $data['parentMenu'] = $this->get_menu();
		$data['dataRole'] = $this->get_role();
        $this->load->view('./templates/header', $data);
		$this->load->view('add_users');
        $this->load->view('./templates/footer');
	}


	public function add(){
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$role_user = htmlspecialchars($this->input->post('role_user'));

		$data = array(
			'id_auth' => 0,
			'username' => $username,
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'role' => $role_user
		);
		$insert = $this->m_data->insert_data('auth', $data);
	}

    public function get_menu(){
		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN auth a ON mn.f_id_auth=a.id_auth JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE a.id_auth=1;")->result_array();
		return $data;
	}

	public function get_role(){
		$data = $this->db->query("SELECT * FROM role")->result_array();
		return $data;
	}

}
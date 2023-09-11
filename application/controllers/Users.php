<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    private $id_auth;
    private $id_role;

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('kode_role')) {
			redirect(base_url('auth'));
		}
        $this->id_auth = $this->session->userdata('id_auth');
        $this->id_role = $this->session->userdata('id_role');
        $this->load->model('m_users');
        $this->load->model('m_menu');
	}

	public function index()
	{
        $data['jumlah_notif'] = $this->m_data->count_notification();
        $data['dataNotif'] = $this->m_data->get_notification();
        $data['dataMenu'] = $this->m_menu->get_menu($this->id_role);
        $data['dataUser'] = $this->m_users->get_user(); 
        $data['jumlah_user'] = $this->m_users->count_user();

        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/users');
        $this->load->view('./templates/footer');
	}

    public function show_user_add(){
        $data['dataMenu'] = $this->m_menu->get_menu($this->id_role);
		$data['dataRole'] = $this->m_users->get_role();
        $data['jumlah_notif'] = $this->m_data->count_notification();
        $data['dataNotif'] = $this->m_data->get_notification();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/add_users');
        $this->load->view('./templates/footer');
    }

    public function add_user(){
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$role_user = htmlspecialchars($this->input->post('role_user'));
        $cek_user = $this->db->get_where('auth', ['username' => $username])->num_rows();

        if ($cek_user > 0) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
        } else {
            $data = array(
                'id_auth' => 0,
                'id_pengguna' => null,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'f_id_role' => $role_user
            );
            $insert = $this->db->insert('auth', $data);
            if ($insert) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Data gagal disimpan.');
            }
        }

        redirect('users');
	}

    public function delete_user()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $id = htmlspecialchars($this->input->post('id_auth'));
            if($id != null){
                $delete = $this->db->delete('auth', array('id_auth' => $id));
                if ($delete) {
                    $this->session->set_flashdata('success', 'Data berhasil dihapus.');
                } else {
                    $this->session->set_flashdata('error', 'Data gagal dihapus.');
                }
            }else{
                $this->session->set_flashdata('error', 'Data gagal dihapus.');
            }
        }
        redirect('users');
    }

    public function show_role_add(){
       $data['dataMenu'] = $this->m_menu->get_menu($this->id_role);
		$data['dataRole'] = $this->m_users->get_role();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/add_role');
        $this->load->view('./templates/footer');
    }
    public function show_user_edit($id){
        $data['jumlah_notif'] = $this->m_data->count_notification();
        $data['dataNotif'] = $this->m_data->get_notification();
       $data['dataMenu'] = $this->m_menu->get_menu($this->id_role);
		$data['dataRole'] = $this->m_users->get_role();
        $data['dataUser'] = $this->m_users->user_by_id($id);
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/edit_user');
        $this->load->view('./templates/footer');
    }

    public function save_edit_user(){
        
        $id_auth = htmlspecialchars($this->input->post('id_auth'));
        $username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$role_user = htmlspecialchars($this->input->post('role_user'));

        
        if($password == "")
        {
            $data = array(
                'username' => $username,
                'f_id_role' => $role_user
            );
        }else{
            $data = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'f_id_role' => $role_user
            );
        }

        $this->db->where('id_auth', $id_auth);
        $update = $this->db->update('auth', $data);

        if($update)
        {
            $this->session->set_flashdata('success', 'Data berhasil diedit.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal diedit.');
        }
        redirect('users');
    }

    public function add_role()
    {
        $role = htmlspecialchars($this->input->post('role'));
        $kode_role = htmlspecialchars($this->input->post('kode_role'));

        $cek_role = $this->db->get_where('role', ['role' => $role])->num_rows();

        if ($cek_role > 0) {
            $this->session->set_flashdata('error', 'Data role sudah ada.');
        } else {
            $data = [
                'role' => $role,
                'kode_role' => $kode_role
            ];

            $insert = $this->db->insert('role', $data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Data gagal disimpan.');
            }
        }

        redirect('users/show_user_add');
    }


   
}
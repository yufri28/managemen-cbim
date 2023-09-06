<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
        $data['parentMenu'] = $this->get_menu();
        $data['dataUser'] = $this->get_user(); 
        $data['jumlah_user'] = $this->count_user();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/users');
        $this->load->view('./templates/footer');
	}


    public function show_user_add(){
        $data['parentMenu'] = $this->get_menu();
		$data['dataRole'] = $this->get_role();
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
        $data['parentMenu'] = $this->get_menu();
		$data['dataRole'] = $this->get_role();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/add_role');
        $this->load->view('./templates/footer');
    }
    public function show_user_edit($id){
        $data['parentMenu'] = $this->get_menu();
		$data['dataRole'] = $this->get_role();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_user/edit_user');
        $this->load->view('./templates/footer');
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


    public function get_menu(){
		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN auth a ON mn.f_id_auth=a.id_auth JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE a.id_auth=1;")->result_array();
		return $data;
	}

    public function get_role(){
		$data = $this->db->query("SELECT * FROM role WHERE kode_role != 1")->result_array();
		return $data;
	}

    public function get_user(){
        $data = $this->db->query("SELECT * FROM auth a JOIN role r ON a.f_id_role=r.id_role WHERE username!='admin';")->result_array();
		return $data;
    }

    public function count_user()
    {
        $data_user = $this->db->query("SELECT COUNT(*) AS jumlah_user FROM auth WHERE username!='admin'")->row_array();
        return $data_user['jumlah_user'];
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('kode_role')) {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['parentMenu'] = $this->get_menu();
        $data['dataMenu'] = $this->get_sub_menu();
        $data['jumlah_menu'] = $this->count_menu();
		$this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/menu');
		$this->load->view('./templates/footer');
	}


    // public function add_menu(){
	// 	$short_name = htmlspecialchars($this->input->post('short_name'));
	// 	$long_name = htmlspecialchars($this->input->post('long_name'));
	// 	$ikon = htmlspecialchars($this->input->post('ikon'));
    //     $link_parent = htmlspecialchars($this->input->post('link_parent'));


    //     $cek_user = $this->db->get_where('auth', ['username' => $username])->num_rows();

    //     if ($cek_user > 0) {
    //         $this->session->set_flashdata('error', 'Username sudah digunakan.');
    //     } else {
    //         $data = array(
    //             'id_auth' => 0,
    //             'id_pengguna' => null,
    //             'username' => $username,
    //             'password' => password_hash($password, PASSWORD_BCRYPT),
    //             'f_id_role' => $role_user
    //         );
    //         $insert = $this->db->insert('auth', $data);
    //         if ($insert) {
    //             $this->session->set_flashdata('success', 'Data berhasil disimpan.');
    //         } else {
    //             $this->session->set_flashdata('error', 'Data gagal disimpan.');
    //         }
    //     }

    //     redirect('menu');
	// }

    public function add_menu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_parent = htmlspecialchars($this->input->post('id_parent'));
            $short_name = htmlspecialchars($this->input->post('short_name'));
            $long_name = htmlspecialchars($this->input->post('long_name'));
            $ikon = $this->input->post('ikon');
            $link_parent = htmlspecialchars($this->input->post('link_parent'));

            $data = array(
                'id_menu' => (int)$id_parent,
                'short_name' => $short_name,
                'long_name' => $long_name,
                'ikon' => $ikon,
                'link_parent' => $link_parent
            );
            
            $insert_parent = $this->db->insert('parent_menu', $data);

            if($insert_parent){
                $sub_names = $this->input->post('sub_name');
                $link_subs = $this->input->post('link_sub');

                foreach ($sub_names as $key => $sub_name) {
                    $data_sub = array(
                        'nama_menu' => $sub_name,
                        'link_menu' => $link_subs[$key],
                        'parent_id' => (int)$id_parent
                    );
                    $insert_sub = $this->db->insert('sub_menu', $data_sub);
                }
            }
            if ($insert_sub) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Data gagal disimpan.');
            }
            redirect('menu');
        }
        $this->load->view('form_menu');
    }


    public function show_menu_add(){
        $data['parentMenu'] = $this->get_menu();
        $data['dataParentMenu'] = $this->get_data_parent();
        $data['jumlah_menu'] = $this->get_last_id();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/add_menu');
        $this->load->view('./templates/footer');
    }

	public function get_sub_menu(){
		$data = $this->db->query("SELECT * FROM parent_menu pm JOIN sub_menu sm ON pm.id_menu=sm.parent_id;")->result_array();
		return $data;
	}

    public function get_data_parent(){
		$data = $this->db->query("SELECT * FROM parent_menu")->result_array();
		return $data;
	}

    public function get_menu(){
		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN auth a ON mn.f_id_auth=a.id_auth JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE a.id_auth=1;")->result_array();
		return $data;
	}

    public function count_menu()
    {
        $data = $this->db->query("SELECT COUNT(*) AS jumlah_menu FROM sub_menu")->row_array();
        return $data['jumlah_menu'];
    }

    public function get_last_id()
    {
        $this->db->select('id_menu');
        $this->db->from('parent_menu');
        $this->db->order_by('id_menu', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['id_menu'];
        } else {
            return null;
        }
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

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
        $this->load->model('m_menu');
	}   

	public function index()
	{
		$data['dataMenu'] = $this->m_menu->get_menu($this->id_role);
        $data['dataSubMenu'] = $this->m_menu->get_sub_menu();
        
        $data['parentMenu'] = $this->m_menu->parent_menu();
        $data['subMenu'] = $this->m_menu->sub_menu();

        $data['jumlah_parent_menu'] = $this->m_menu->count_parent_menu();
        $data['jumlah_sub_menu'] = $this->m_menu->count_sub_menu();

        $data['jumlah_notif'] = $this->m_menu->count_notification();
		$this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/menu');
		$this->load->view('./templates/footer');
	}
   
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

    public function edit_menu()
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

            $update_parent = $this->db->update('parent_menu', $data, array('id_menu' => $id_parent));

            if($update_parent){
                $sub_names = $this->input->post('sub_name');
                $link_subs = $this->input->post('link_sub');

                if (isset($sub_names) && isset($link_subs)) {
                    foreach ($sub_names as $key => $sub_name) {
                        $data_sub = array(
                            'nama_menu' => $sub_name,
                            'link_menu' => $link_subs[$key],
                            'parent_id' => (int)$id_parent
                        );
                        $insert_sub = $this->db->insert('sub_menu', $data_sub);
                    }
                    if (isset($insert_sub)) {
                        $this->session->set_flashdata('success', 'Data berhasil diupdate.');
                    } else {
                        $this->session->set_flashdata('error', 'Data gagal diupdate.');
                    }
                }else{
                    if ($update_parent && $insert_sub == false) {
                        $this->session->set_flashdata('success', 'Data berhasil diupdate.');
                    } else {
                        $this->session->set_flashdata('error', 'Data gagal diupdate.');
                    }
                }
            }

            redirect('menu');
        }
        $this->load->view('form_menu');
    }

    public function show_menu_add(){
        $data['dataMenu'] = $this->m_menu->get_menu($this->id_auth);
        $data['dataSubMenu'] = $this->m_menu->get_sub_menu();
        $data['jumlah_menu'] = $this->m_menu->get_last_id();
        $data['jumlah_notif'] = $this->m_menu->count_notification();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/add_menu');
        $this->load->view('./templates/footer');
    }

    public function show_menu_edit($id_menu){
        $data['dataMenu'] = $this->m_menu->get_menu($this->id_auth);
        $data['dataSubMenu'] = $this->m_menu->sub_menu_by_id($id_menu);
        $data['parentMenu'] = $this->m_menu->parent_menu_by_id($id_menu);
        $data['jumlah_menu'] = $this->m_menu->get_last_id();
        $data['jumlah_notif'] = $this->m_menu->count_notification();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/edit_menu');
        $this->load->view('./templates/footer');
    }

    public function akses_pengguna()
    {
        $data['parentMenu'] = $this->m_menu->get_menu($this->id_auth);
        $data['dataMenu'] = $this->m_menu->get_sub_menu();
        $data['jumlah_menu'] = $this->m_menu->count_menu();
        $data['jumlah_notif'] = $this->m_menu->count_notification();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/akses_pengguna');
        $this->load->view('./templates/footer');
    }

    public function show_akses_add($id)
    {    
        $data['dataMenu'] = $this->m_menu->get_menu($this->id_auth);
        $data['dataParentMenu'] = $this->m_menu->parent_by_id($id);
        $data['jumlah_menu'] = $this->m_menu->get_last_id();
        $data['dataRole'] = $this->m_menu->get_all_role();
        $data['jumlah_notif'] = $this->m_menu->count_notification();
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/add_akses');
        $this->load->view('./templates/footer');
    }

    public function save_akses()
    {
        $id_role = $this->input->post('id_role');
        $id_menu = $this->input->post('id_menu');

        foreach ($id_role as $key => $id) {
            $data = array(
                'f_id_menu' => $id_menu,
                'f_id_role' => $id
            );
            $insert = $this->db->query("INSERT IGNORE INTO man_navbar (f_id_menu,f_id_role) VALUES ('$id_menu','$id')");

            $notif = array(
                'isi_notifikasi' => "Menambah 2 akses",
                'status' => '0',
                'create_at' => date('Y-m-d H:i:s')
            );
           $this->db->insert('notifikasi', $notif);
        }

        if ($insert) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal disimpan.');
        }
        redirect('menu');
    }

    public function hapus_akses()
    {
        $id_akses = $this->input->post('id_man_nav');
        if (!empty($id_akses)) {
            $this->db->where('id', $id_akses);
            $this->db->delete('man_navbar');
            if ($this->db->affected_rows() > 0) {
                $response = array('status' => 'success', 'message' => 'Akses berhasil dihapus');
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function hapus_parent()
    {
        $id_menu = $this->input->post('id_menu');
        if (!empty($id_menu)) {
            $this->db->where('id_menu', $id_menu);
            $this->db->delete('parent_menu');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Data gagal dihapus.');
            }
        }
        redirect('menu');
    }

    public function edit_sub($id_sub)
    {
        $data['dataMenu'] = $this->m_menu->get_menu($this->id_auth);
        $data['dataSubMenu'] = $this->m_menu->sub_by_id($id_sub);
        $this->load->view('./templates/header', $data);
		$this->load->view('./manajemen_menu/edit_sub_menu');
        $this->load->view('./templates/footer');
    }

    public function save_edit_sub()
    {
        $id_sub = $this->input->post('id_sub');
        $nama_menu = $this->input->post('nama_menu');
        $link_menu = $this->input->post('link_menu');
        $parent_id = $this->input->post('id_parent');

        $data = array(
            'nama_menu' => $nama_menu,
            'link_menu' => $link_menu,
            'parent_id' => $parent_id
        );

        $update_sub = $this->db->update('sub_menu', $data, array('id_sub' => $id_sub));

        if ($update_sub) {
            $this->session->set_flashdata('success', 'Data berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal diupdate.');
        }
        redirect('menu');
    }

    public function hapus_sub_menu()
    {
        $id_sub = $this->input->post('id_sub');
        if (!empty($id_sub)) {
            $this->db->where('id_sub', $id_sub);
            $this->db->delete('sub_menu');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Data gagal dihapus.');
            }
        }
        redirect('menu');
    }

    public function hapus_sub()
    {     
        $id_sub = $this->input->post('id_sub');
        if (!empty($id_sub)) {
            $this->db->where('id_sub', $id_sub);
            $this->db->delete('sub_menu');
            if ($this->db->affected_rows() > 0) {
                $notif = array(
                    'isi_notifikasi' => "Menambah 2 akses",
                    'status' => '0',
                    'create_at' => date('Y-m-d H:i:s')
                );
               $this->db->insert('notifikasi', $notif);
               $total_notif = $this->m_menu->count_notification();
               $response = array('status' => 'success', 'message' => 'Akses berhasil dihapus','total_notif' => $total_notif);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

	

}
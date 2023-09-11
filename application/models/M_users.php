<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_users extends CI_Model
{
    public function get_menu($id_role=null){
		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN role r ON mn.f_id_role=r.id_role JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE r.id_role='$id_role';")->result_array();
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

    public function user_by_id($id=null){
        $data = $this->db->query("SELECT * FROM auth WHERE id_auth='$id';")->result_array();
		return $data;
    }


    public function count_user()
    {
        $data_user = $this->db->query("SELECT COUNT(*) AS jumlah_user FROM auth WHERE username!='admin'")->row_array();
        return $data_user['jumlah_user'];
    }

    public function count_notification(){
     
        $data = $this->db->query("SELECT COUNT(*) AS jumlah_notif FROM notifikasi")->row_array();

        return $data['jumlah_notif'];
    }
}

?>
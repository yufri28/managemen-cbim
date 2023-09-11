<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_menu extends CI_Model
{
    public function count_notification(){
     
        $data = $this->db->query("SELECT COUNT(*) AS jumlah_notif FROM notifikasi")->row_array();

        return $data['jumlah_notif'];
    }

    public function get_sub_menu(){
		$data = $this->db->query("SELECT * FROM parent_menu pm JOIN sub_menu sm ON pm.id_menu=sm.parent_id;")->result_array();
		return $data;
	}

    public function sub_by_id($id_sub){

		$data = $this->db->query("SELECT * FROM parent_menu pm JOIN sub_menu sm ON pm.id_menu=sm.parent_id WHERE sm.id_sub='$id_sub'")->result_array();
		return $data;
	}

    public function get_all_role(){
		$data = $this->db->query("SELECT * FROM role")->result_array();
		return $data;
	}

    public function parent_by_id($id){
		$data = $this->db->query("SELECT * FROM parent_menu WHERE id_menu='$id'")->result_array();
		return $data;
	}

    public function get_data_parent(){
		$data = $this->db->query("SELECT * FROM parent_menu")->result_array();
		return $data;
	}

    public function get_menu($id_role=null){
		$data = $this->db->query("SELECT * FROM man_navbar mn JOIN role r ON mn.f_id_role=r.id_role JOIN parent_menu pm ON pm.id_menu=mn.f_id_menu WHERE r.id_role='$id_role';")->result_array();
		return $data;
	}

    public function parent_menu(){
		$data = $this->db->query("SELECT * FROM parent_menu;")->result_array();
		return $data;
	}

    public function parent_menu_by_id($id_parent){
		$data = $this->db->query("SELECT * FROM parent_menu WHERE id_menu='$id_parent';")->result_array();
		return $data;
	}

    public function sub_menu(){
		$data = $this->db->query("SELECT * FROM sub_menu;")->result_array();
		return $data;
	}

    public function sub_menu_by_id($id_parent){
		$data = $this->db->query("SELECT * FROM sub_menu WHERE parent_id='$id_parent';")->result_array();
		return $data;
	}


    public function count_menu()
    {
        $data = $this->db->query("SELECT COUNT(*) AS jumlah_menu FROM sub_menu")->row_array();
        return $data['jumlah_menu'];
    }

    public function count_parent_menu()
    {
        $data = $this->db->query("SELECT COUNT(*) AS jumlah_parent_menu FROM parent_menu")->row_array();
        return $data['jumlah_parent_menu'];
    }

    public function count_sub_menu()
    {
        $data = $this->db->query("SELECT COUNT(*) AS jumlah_sub_menu FROM sub_menu")->row_array();
        return $data['jumlah_sub_menu'];
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

?>
<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_data extends CI_Model
{
    //fungsi untuk mengambil data dari database
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    //fungsi untuk insert data ke database
    public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
    }

    //fungsi untuk mengambil data untuk di edit
    public function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    //fungsi untuk mengupdate data di database
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //fungsi untuk menghapus data
    public function delete_data($where, $table)
    {
        $this->db->delete($table, $where);
    }
}

?>
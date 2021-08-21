<?php
class MyMode extends CI_Model
{

    public function tampilkanData($table)
    {
        $query = $this->db->get($table);
        return $query;
    }
    public function tambahdata($data, $table)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }
    public function itemById($id, $table)
    {
        $query = $this->db->query("SELECT * FROM $table WHERE id = '$id' ");
        return $query;
    }
    public function ubahData($data, $table, $where)
    {
        $this->db->update($table, $data, $where);
    }
    public function hapusData($where, $table)
    {
        $this->db->delete($table, array('id' => $where));
    }
    public function laporan()
    {
        $query = $this->db->query("SELECT * FROM pembayaran, items WHERE pembayaran.id_item = items.id");
        return $query;
    }
}

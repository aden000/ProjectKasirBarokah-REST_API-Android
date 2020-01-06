<?php

class M_barang extends CI_Model{
    function getBarang($id = null){
        if($id === null){
            return $this->db->query('SELECT a.id_barang, b.nama_kategori, a.nama_barang, a.harga_barang, a.stok_barang from barang a join kategori b on a.id_kategori = b.id_kategori order by a.id_barang asc')->result_array();
        } else {
            return $this->db->query('SELECT a.id_barang, b.nama_kategori, a.nama_barang, a.harga_barang, a.stok_barang from barang a join kategori b on a.id_kategori = b.id_kategori where a.id_barang = '. $id)->result_array();
        }
    }

    function insertBarang($data){
        $this->db->insert('barang', $data);
        return $this->db->affected_rows();
    }

    function updateBarang($data, $where){
        $this->db->update('barang', $data, ['id_barang' => $where]);
        return $this->db->affected_rows();
    }

    function deleteBarang($where){
        $this->db->where('id_barang', $where);
        $this->db->delete('barang');
        return $this->db->affected_rows();
    }

    function getKategori(){
        return $this->db->get('kategori')->result_array();
    }
}
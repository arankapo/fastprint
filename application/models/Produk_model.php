<?php
class Produk_model extends CI_Model {

    public function get_all_with_relations() {
        $this->db->select('produk.*, kategori.nama_kategori, status.nama_status');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.kategori_id = kategori.id_kategori');
        $this->db->join('status', 'produk.status_id = status.id_status');
        // Poin 5: Hanya tampilkan yang bisa dijual
        $this->db->where('status.nama_status', 'bisa dijual');
        return $this->db->get()->result();
    }

    public function get_kategori() {
        $this->db->select('id_kategori, nama_kategori');
        $this->db->group_by('nama_kategori'); 
        return $this->db->get('kategori')->result();
    }

    public function get_status() {
        $this->db->select('id_status, nama_status');
        $this->db->group_by('nama_status');
        return $this->db->get('status')->result();
    }

    public function insert($data) {
        return $this->db->insert('produk', $data);
    }

    public function get_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row();
    }

    public function update($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update('produk', $data);
    }

    public function delete($id) {
        return $this->db->delete('produk', ['id_produk' => $id]);
    }
}
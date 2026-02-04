<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    public function index() {
        $data['produk'] = $this->Produk_model->get_all_with_relations();
        $this->load->view('produk_view', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori'] = $this->Produk_model->get_kategori();
            $data['status'] = $this->Produk_model->get_status();
            $this->load->view('tambah_view', $data);
        } else {
            $data_post = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id'   => $this->input->post('status_id')
            ];
            $this->Produk_model->insert($data_post);
            redirect('produk');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['produk'] = $this->Produk_model->get_by_id($id);
            $data['kategori'] = $this->Produk_model->get_kategori();
            $data['status'] = $this->Produk_model->get_status();
            $this->load->view('edit_view', $data);
        } else {
            $data_post = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id'   => $this->input->post('status_id')
            ];
            $this->Produk_model->update($id, $data_post);
            redirect('produk');
        }
    }

    public function hapus($id) {
        $this->Produk_model->delete($id);
        redirect('produk');
    }

    // Tambahkan fungsi ini di dalam class Produk di application/controllers/Produk.php
    public function fetch_api() {
        $username = "tesprogrammer040226C11";
        $password = md5("bisacoding-04-02-26");

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query(['username' => $username, 'password' => $password]),
            ],
        ];

        $context  = stream_context_create($options);
        $response = @file_get_contents('https://recruitment.fastprint.co.id/tes/api_tes_programmer', false, $context);

        if ($response === FALSE) {
            $this->session->set_flashdata('error', 'Gagal terhubung ke API. Cek koneksi atau kredensial.');
            redirect('produk');
        }

        $data = json_decode($response, true);

        if ($data && isset($data['data'])) {
            foreach ($data['data'] as $item) {
                // Logika insert kategori & status (pastikan Model sudah mendukung ini)
                $this->db->query("INSERT IGNORE INTO kategori (nama_kategori) VALUES ('{$item['kategori']}')");
                $kat_id = $this->db->query("SELECT id_kategori FROM kategori WHERE nama_kategori='{$item['kategori']}'")->row()->id_kategori;

                $this->db->query("INSERT IGNORE INTO status (nama_status) VALUES ('{$item['status']}')");
                $stat_id = $this->db->query("SELECT id_status FROM status WHERE nama_status='{$item['status']}'")->row()->id_status;

                // Insert produk menggunakan fungsi insert di model
                $data_produk = [
                    'nama_produk' => $item['nama_produk'],
                    'harga'       => $item['harga'],
                    'kategori_id' => $kat_id,
                    'status_id'   => $stat_id
                ];
                $this->Produk_model->insert($data_produk);
            }
            $this->session->set_flashdata('success', 'Data berhasil disinkronkan dari API!');
        }
        redirect('produk');
    }
}
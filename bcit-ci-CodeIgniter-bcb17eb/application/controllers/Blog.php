<?php
// Mencegah akses langsung ke file script [cite: 160, 180]
defined('BASEPATH') OR exit('No direct script access allowed');

// Nama class harus sama dengan nama file dan diawali huruf besar [cite: 164, 179]
class Blog extends CI_Controller {

    public function index() {
        // Data artikel berupa data statis (array) sesuai soal 
        $data['judul_halaman'] = "Halaman Home - Daftar Artikel";
        $data['artikel'] = [
            [
                'id' => 1,
                'judul' => 'Belajar CodeIgniter 3',
                'penulis' => 'Yusran',
                'isi' => 'MVC adalah konsep pemisahan logic dan presentation[cite: 36, 50].'
            ],
            [
                'id' => 2,
                'judul' => 'Tips Optimasi ThinkPad',
                'penulis' => 'Admin',
                'isi' => 'Gunakan settingan Dolby Access yang tepat untuk audio maksimal.'
            ]
        ];

        // Memanggil View dan mengirimkan data array tersebut [cite: 102, 182, 255]
        $this->load->view('view_home', $data);
    }

    public function detail($id) {
        // Simulasi Halaman Detail Artikel [cite: 14]
        $data['judul_halaman'] = "Detail Artikel";
        $this->load->view('view_detail', $data);
    }

    public function tentang() {
        // Halaman Tentang Website [cite: 15]
        $data['judul_halaman'] = "Tentang Kami";
        $this->load->view('view_about', $data);
    }

    public function tambah() {
        // Halaman Form Tambah Artikel (Simulasi) [cite: 16]
        $data['judul_halaman'] = "Tambah Artikel Baru";
        $this->load->view('view_tambah', $data);
    }
}
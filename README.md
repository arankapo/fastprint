Tes Junior Programmer - Fast Print
Repositori ini berisi penyelesaian tugas seleksi Junior Programmer di Fast Print Surabaya. Aplikasi ini dibangun menggunakan framework CodeIgniter 3 dengan database MySQL.

Fitur Utama
Sinkronisasi API: Mengambil data produk secara otomatis dari API Fast Print menggunakan metode POST dengan autentikasi MD5.

Manajemen Produk (CRUD): Fitur lengkap untuk menambah, menampilkan, mengubah, dan menghapus data produk.

Filter Otomatis: Sesuai instruksi, halaman utama hanya menampilkan produk dengan status "bisa dijual".

Validasi Input: Form tambah dan edit dilengkapi validasi (Nama wajib diisi, Harga harus angka) untuk menjaga integritas data.

Konfirmasi Hapus: Alert konfirmasi berbasis JavaScript sebelum menghapus data untuk mencegah kesalahan user.

Skenario Pengujian (Untuk Dokumentasi)
Persiapan: Pastikan tabel produk kosong atau jalankan fitur reset data.

Sinkronisasi: Klik tombol "Sinkronisasi API" pada halaman utama. Sistem akan melakukan request ke server Fast Print dan mengisi tabel secara otomatis.

Tampilan: Verifikasi bahwa data yang muncul hanyalah data yang memiliki label status "bisa dijual".

Operasi CRUD:

Coba tambahkan produk baru.

Coba edit produk yang sudah ada.

Coba hapus produk dan perhatikan munculnya dialog konfirmasi.


Cara Instalasi
1. Clone repositori ini ke folder htdocs kamu.
2. Import file database fastprint_test.sql melalui phpMyAdmin.
3. Sesuaikan konfigurasi database di application/config/database.php.
4. Buka browser dan akses http://localhost/fastprint/index.php/produk.

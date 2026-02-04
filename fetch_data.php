<?php
// Konfigurasi DB
$host = "localhost"; $user = "root"; $pass = ""; $db = "fastprint_test";
$conn = new mysqli($host, $user, $pass, $db);

// Data Auth
$username = "tesprogrammer040226C11";
$password = md5("bisacoding-04-02-26");

// Header untuk POST
$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query(['username' => $username, 'password' => $password]),
    ],
];

$context  = stream_context_create($options);
$response = file_get_contents('https://recruitment.fastprint.co.id/tes/api_tes_programmer', false, $context);
$data = json_decode($response, true);

if ($data && isset($data['data'])) {
    foreach ($data['data'] as $item) {
        // 1. Cek/Insert Kategori
        $conn->query("INSERT IGNORE INTO kategori (nama_kategori) VALUES ('{$item['kategori']}')");
        $kat_id = $conn->query("SELECT id_kategori FROM kategori WHERE nama_kategori='{$item['kategori']}'")->fetch_assoc()['id_kategori'];

        // 2. Cek/Insert Status
        $conn->query("INSERT IGNORE INTO status (nama_status) VALUES ('{$item['status']}')");
        $stat_id = $conn->query("SELECT id_status FROM status WHERE nama_status='{$item['status']}'")->fetch_assoc()['id_status'];

        // 3. Insert Produk
        $sql = "INSERT INTO produk (id_produk, nama_produk, harga, kategori_id, status_id) 
                VALUES ('{$item['id_produk']}', '{$item['nama_produk']}', '{$item['harga']}', '$kat_id', '$stat_id')
                ON DUPLICATE KEY UPDATE nama_produk='{$item['nama_produk']}', harga='{$item['harga']}'";
        $conn->query($sql);
    }
    echo "Data berhasil disinkronkan!";
}
?>
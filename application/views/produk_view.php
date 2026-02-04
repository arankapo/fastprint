<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Produk (Hanya Bisa Dijual)</h3>
        <div>
            <a href="<?= site_url('produk/fetch_api') ?>" class="btn btn-info text-white" onclick="return confirm('Ambil data baru dari API?')">
                Ambil Data dari API
            </a>
            <a href="<?= site_url('produk/tambah') ?>" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    
    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produk as $p): ?>
            <tr>
                <td><?= $p->id_produk ?></td>
                <td><?= $p->nama_produk ?></td>
                <td><?= number_format($p->harga, 0, ',', '.') ?></td>
                <td><?= $p->nama_kategori ?></td>
                <td><span class="badge bg-success"><?= $p->nama_status ?></span></td>
                <td>
                    <a href="<?= site_url('produk/edit/'.$p->id_produk) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= site_url('produk/hapus/'.$p->id_produk) ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
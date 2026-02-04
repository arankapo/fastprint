<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Fast Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Tambah Produk</h5>
                </div>
                <div class="card-body">
                    
                    <?php if(validation_errors()): ?>
                        <div class="alert alert-danger pb-0">
                            <?= validation_errors('<li>', '</li>'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('produk/tambah') ?>" method="post">
                       

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?= set_value('nama_produk') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" value="<?= set_value('harga') ?>">
                            <small class="text-muted">Input hanya boleh angka.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select">
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status_id" class="form-select">
                                <?php foreach($status as $s): ?>
                                    <option value="<?= $s->id_status ?>"><?= $s->nama_status ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('produk') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
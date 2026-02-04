<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container bg-white p-4 shadow-sm rounded">
    <h2>Edit Produk</h2>
    <hr>
    
    <?php if(validation_errors()): ?>
        <div class="alert alert-danger"><?= validation_errors(); ?></div>
    <?php endif; ?>

    <form action="<?= site_url('produk/edit/'.$produk->id_produk) ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="<?= $produk->nama_produk ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $produk->harga ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select">
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k->id_kategori ?>" <?= ($k->id_kategori == $produk->kategori_id) ? 'selected' : '' ?>>
                        <?= $k->nama_kategori ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status_id" class="form-select">
                <?php foreach($status as $s): ?>
                    <option value="<?= $s->id_status ?>" <?= ($s->id_status == $produk->status_id) ? 'selected' : '' ?>>
                        <?= $s->nama_status ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= site_url('produk') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
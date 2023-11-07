<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA BARANG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Pengelolaan Data Barang
            </li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Form Tambah Barang -->
                <form action="<?= base_url('barang/edit/' . $result['barang_id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="slug" value="<?= $result['slug'] ?>">
                    <div class="mb-3 row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('nama_barang') ? 'is-invalid' : '' ?>" id="nama_barang" name="nama_barang" value="<?= old('nama_barang', $result['nama_barang']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('nama_barang') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : '' ?>" id="stok" name="stok" value="<?= old('stok', $result['stok']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stok') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="satuanbarang" class="col-sm-2 col-form-label">Satuan Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('satuanbarang') ? 'is-invalid' : '' ?>" id="satuanbarang" name="satuanbarang" value="<?= old('satuanbarang', $result['satuanbarang']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('satuanbarang') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga', $result['harga']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('harga') ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                        <a class="btn btn-danger" type="button" href="<?= base_url('barang') ?>">Batal</a>
                    </div>
                </form>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
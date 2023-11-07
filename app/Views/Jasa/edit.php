<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA JASA</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Pengelolaan Data Jasa
            </li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Form Tambah Jasa -->
                <form action="<?= base_url('jasa/edit/' . $result['jasa_id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="slug" value="<?= $result['slug'] ?>">
                    <div class="mb-3 row">
                        <label for="layanan" class="col-sm-2 col-form-label">Layanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('layanan') ? 'is-invalid' : '' ?>" id="layanan" name="layanan" value="<?= old('layanan', $result['layanan']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('layanan') ?>
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
                        <a class="btn btn-danger" type="button" href="<?= base_url('jasa') ?>">Batal</a>
                    </div>
                </form>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
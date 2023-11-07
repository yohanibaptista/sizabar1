<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA JASA</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                PENGELOLAAN DATA BARANG
            </li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Isi Detail -->
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">Layanan :<?= $result['nama_barang'] ?></p>
                                <p class="card-text">Stok :<?= $result['stok'] ?></p>
                                <p class="card-text">Satuan Barang :<?= $result['satuanbarang'] ?></p>
                                <p class="card-text">Harga :<?= $result['harga'] ?></p>
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-dark" type="button" href="<?= base_url('barang') ?>">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
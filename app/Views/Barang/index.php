<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA BARANG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                PENGELOLAAN DATA BARANG
            </li>
        </ol>
        <!-- Start Flash Data -->
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Data -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <a class="btn btn-primary mb-3" type="button" href="<?= base_url('barang/create') ?>">Tambah Barang</a>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Satuan Barang</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($result as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama_barang'] ?></td>
                                <td><?= $value['stok'] ?></td>
                                <td><?= $value['satuanbarang'] ?></td>
                                <td><?= $value['harga'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?= base_url('barang/' . $value['slug']) ?>" role="button">Detail</a>
                                    <a class="btn btn-warning" href="<?= base_url('barang/edit/' . $value['slug']) ?>" role="button">Ubah</a>
                                    <form action="<?= base_url('barang/' . $value['barang_id']) ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" role="button" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <main>
            <?= $this->endSection() ?>
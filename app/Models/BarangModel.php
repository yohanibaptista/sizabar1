<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    // Nama Tabel
    protected $table        = 'barang';
    // Atribut yang digunakan menjadi primary key
    protected $primaryKey   = 'barang_id';
    // Atribut untuk menyimpan created at dan updated at

    protected $allowedFields = [
        'nama_barang', 'stok', 'satuanbarang', 'harga', 'slug'
    ];

    // protected $useSoftDeletes = true;

    public function getBarang($slug = false)
    {
        $query = $this->table('barang');

        if ($slug == false)
            return $query->get()->getResultArray();
        return $query->where(['slug' => $slug])->first();
    }
}

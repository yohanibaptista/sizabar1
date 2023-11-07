<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaModel extends Model
{
    // Nama Tabel
    protected $table        = 'jasa';
    // Atribut yang digunakan menjadi primary key
    protected $primaryKey   = 'jasa_id';
    // Atribut untuk menyimpan created at dan updated at
    protected $useTimestamps = true;
    protected $allowedFields = [
        'layanan', 'harga','slug'
    ];

    // protected $useSoftDeletes = true;

    public function getJasa($slug = false)
    {
        $query = $this->table('jasa');

        if ($slug == false)
            return $query->get()->getResultArray();
        return $query->where(['slug' => $slug])->first();
    }
}

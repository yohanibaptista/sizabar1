<?php

namespace App\Controllers;

use \App\Models\BarangModel;

class Barang extends BaseController
{
    private $barangModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $dataBarang = $this->barangModel->findAll();
        $data = [
            'title' => 'Data Barang',
            'result' => $dataBarang
        ];
        return view('barang/index', $data);
    }

    public function detail($slug)
    {
        $dataBarang = $this->barangModel->getBarang($slug);
        $data = [
            'title' => 'Detail Barang',
            'result' => $dataBarang
        ];
        return view('barang/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Tambah Barang',
            'validation' => \Config\Services::validation()
        ];
        return view('barang/create', $data);
    }

    public function save()
    {
        // Validasi Input
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required|is_unique[barang.nama_barang]',
                'label' => 'Barang',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah ada!'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'label' => 'Stok',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'numeric' => '{field} harus berupa angka!'
                ]
            ],
            'satuanbarang' => [
                'rules' => 'required',
                'label' => 'SatuanBarang',
                'errors' => [
                    'required' => '{field} harus diisi!',
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'label' => 'Harga',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'numeric' => '{field} harus berupa angka!'
                ]
            ],
        ])) {
            return redirect()->to('/barang/create')->withInput();
        }

        $slug = url_title($this->request->getVar('nama_barang'), '-', true);
        $this->barangModel->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'stok' => $this->request->getVar('stok'),
            'satuanbarang' => $this->request->getVar('satuanbarang'),
            'harga' => $this->request->getVar('harga'),
            'slug' => $slug,
        ]);

        session()->setFlashdata("msg", "Data barang berhasil ditambahkan!");
        return redirect()->to('/barang');
    }

    public function edit($slug)
    {
        $dataBarang = $this->barangModel->getBarang($slug);
        //jika data barangnya kosong
        if (empty($dataBarang)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Barang $slug tidak ditemukan");
        }

        $data = [
            'title' => 'Ubah Barang',
            'validation' => \Config\Services::validation(),
            'result' => $dataBarang
        ];
        return view('barang/edit', $data);
    }

    public function update($id)
    {
        // Cek Judul
        $dataOld = $this->barangModel->getBarang($this->request->getVar('slug'));
        if ($dataOld['nama_barang'] == $this->request->getVar('nama_barang')) {
            $rule_title = "required";
        } else {
            $rule_title = 'required|is_unique[barang.nama_barang]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_barang' => [
                'rules' => $rule_title,
                'label' => 'Nama_barang',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah ada!'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'label' => 'Stok',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'numeric' => '{field} harus berupa angka!'
                ]
            ],
            'satuanbarang' => [
                'rules' => 'required',
                'label' => 'SatuanBarang',
                'errors' => [
                    'required' => '{field} harus diisi!',
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'label' => 'Harga',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'numeric' => '{field} harus berupa angka!'
                ]
            ],
        ])) {
            return redirect()->to('/barang/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('nama_barang'), '-', true);
        $this->barangModel->save([
            'barang_id' => $id,
            'nama_barang' => $this->request->getVar('nama_barang'),
            'stok' => $this->request->getVar('stok'),
            'satuanbarang' => $this->request->getVar('satuanbarang'),
            'harga' => $this->request->getVar('harga'),
            'slug' => $slug,
        ]);

        session()->setFlashdata("msg", "Data barang berhasil diubah!");

        return redirect()->to('/barang');
    }

    public function delete($barang_id)
    {
        $this->barangModel->delete($barang_id);
        session()->setFlashdata("msg", "Data barang berhasil dihapus!");
        return redirect()->to('/barang');
    }
}

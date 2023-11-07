<?php

namespace App\Controllers;

use \App\Models\JasaModel;

class Jasa extends BaseController
{
    private $jasaModel;
    public function __construct()
    {
        $this->jasaModel = new JasaModel();
    }

    public function index()
    {
        $dataJasa = $this->jasaModel->findAll();
        $data = [
            'title' => 'Data Jasa',
            'result' => $dataJasa
        ];
        return view('jasa/index', $data);
    }

    public function detail($slug)
    {
        $dataJasa = $this->jasaModel->getJasa($slug);
        $data = [
            'title' => 'Detail Jasa',
            'result' => $dataJasa
        ];
        return view('jasa/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Tambah Jasa',
            'validation' => \Config\Services::validation()
        ];
        return view('jasa/create', $data);
    }

    public function save()
    // {
    //     $validation = \Config\Services::validation();

    //     $rules = [
    //         'layanan' => [
    //             'rules' => 'required|is_unique[jasa.layanan]',
    //             'label' => 'Layanan',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah ada'
    //             ]
    //         ],
    //         'harga' => [
    //             'rules' => 'required|integer',
    //             'label' => 'Harga',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'integer' => '{field} harus berupa angka'
    //             ]
    //         ],

    //     ];

    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput();
    //     }

    //     $slug = url_title($this->request->getVar('layanan'), '-', true);
    //     $this->jasaModel->save([
    //         'layanan' => $this->request->getVar('layanan'),
    //         'harga' => $this->request->getVar('harga'),
    //         'slug' => $slug,
    //     ]);

    //     session()->setFlashdata("msg", "Data jasa berhasil ditambahkan!");
    //     return redirect()->to('/jasa');
    // }

    {
        // Validasi Input
        if (!$this->validate([
            'layanan' => [
                'rules' => 'required|is_unique[jasa.layanan]',
                'label' => 'Jasa',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah ada!'
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
            return redirect()->to('/jasa/create')->withInput();
        }

        $slug = url_title($this->request->getVar('layanan'), '-', true);
        $this->jasaModel->save([
            'layanan' => $this->request->getVar('layanan'),
            'harga' => $this->request->getVar('harga'),
            'slug' => $slug,
        ]);

        session()->setFlashdata("msg", "Data jasa berhasil ditambahkan!");
        return redirect()->to('/jasa');
    }

    public function edit($slug)
    {
        $dataJasa = $this->jasaModel->getJasa($slug);
        //jika data jasanya kosong
        if (empty($dataJasa)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Layanan $slug tidak ditemukan");
        }

        $data = [
            'title' => 'Ubah Jasa',
            'validation' => \Config\Services::validation(),
            'result' => $dataJasa
        ];
        return view('jasa/edit', $data);
    }

    public function update($id)
    {
        // Cek Judul
        $dataOld = $this->jasaModel->getJasa($this->request->getVar('slug'));
        if ($dataOld['layanan'] == $this->request->getVar('layanan')) {
            $rule_title = "required";
        } else {
            $rule_title = 'required|is_unique[jasa.layanan]';
        }

        // Validasi Data
        if (!$this->validate([
            'layanan' => [
                'rules' => $rule_title,
                'label' => 'Layanan',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah ada!'
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
            return redirect()->to('/jasa/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('layanan'), '-', true);
        $this->jasaModel->save([
            'jasa_id' => $id,
            'layanan' => $this->request->getVar('layanan'),
            'harga' => $this->request->getVar('harga'),
            'slug' => $slug,
        ]);

        session()->setFlashdata("msg", "Data jasa berhasil diubah!");

        return redirect()->to('/jasa');
    }

    public function delete($jasa_id)
    {
        $this->jasaModel->delete($jasa_id);
        session()->setFlashdata("msg", "Data jasa berhasil dihapus!");
        return redirect()->to('/jasa');
    }
}

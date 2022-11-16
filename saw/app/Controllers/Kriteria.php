<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    protected $kriteria;
    protected $validation;

    public function __construct()
    {
        helper('form');
        $this->kriteria = new KriteriaModel();
        $this->validation = service('validation');
    }

    public function index()
    {
        $data['kriteria'] = $this->kriteria->findAll();

        return view('kriteria/data', $data);
    }

    public function tambah()
    {
        if ($this->request->getPost()) {
            $this->validation->setRules([
                'kode_kriteria' => ['label' => 'Kode Kriteria', 'rules' => ['required', 'is_unique[kriteria.kode_kriteria]'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah ada']],
                'nama_kriteria' => ['label' => 'Nama Kriteria', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'bobot' => ['label' => 'Bobot', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'tipe' => ['label' => 'Tipe', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'kode_kriteria' => $this->request->getPost('kode_kriteria'),
                    'nama_kriteria' => $this->request->getPost('nama_kriteria'),
                    'bobot' => $this->request->getPost('bobot'),
                    'tipe' => $this->request->getPost('tipe'),
                ];
                $this->kriteria->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil ditambahkan</div>');
                return redirect('kriteria');
            }

            return redirect()->back()->withInput();
        }

        return view('kriteria/tambah');
    }

    public function ubah($id)
    {
        $data['kriteria'] = $this->kriteria->where('id_kriteria', $id)->first();

        if ($this->request->getPost()) {
            $this->validation->setRules([
                'kode_kriteria' => ['label' => 'Kode kriteria', 'rules' => ['required', 'is_unique[kriteria.kode_kriteria,id_kriteria,' . $id . ']'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah ada']],
                'nama_kriteria' => ['label' => 'Nama kriteria', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'bobot' => ['label' => 'Bobot', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'tipe' => ['label' => 'Tipe', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'id_kriteria' => $id,
                    'kode_kriteria' => $this->request->getPost('kode_kriteria'),
                    'nama_kriteria' => $this->request->getPost('nama_kriteria'),
                    'bobot' => $this->request->getPost('bobot'),
                    'tipe' => $this->request->getPost('tipe'),
                ];
                $this->kriteria->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil diubah</div>');
                return redirect('kriteria');
            }

            return redirect()->back()->withInput();
        }

        return view('kriteria/ubah', $data);
    }

    public function hapus($id)
    {
        $this->kriteria->delete($id);
        session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil dihapus</div>');

        return redirect('kriteria');
    }
}

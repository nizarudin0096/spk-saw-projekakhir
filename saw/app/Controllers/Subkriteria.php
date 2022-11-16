<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubkriteriaModel;

class Subkriteria extends BaseController
{
    protected $kriteria;
    protected $subkriteria;
    protected $validation;

    public function __construct()
    {
        helper('form');
        $this->kriteria = new KriteriaModel();
        $this->subkriteria = new SubkriteriaModel();
        $this->validation = service('validation');
    }

    public function index($id_kriteria)
    {
        $data['kriteria'] = $this->kriteria->find($id_kriteria);
        $data['subkriteria'] = $this->subkriteria->where('id_kriteria', $id_kriteria)->findAll();

        return view('subkriteria/data', $data);
    }

    public function tambah($id_kriteria)
    {
        $data['id_kriteria'] = $id_kriteria;

        if ($this->request->getPost()) {
            $this->validation->setRules([
                'nama_subkriteria' => ['label' => 'Nama Subkriteria', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'bobot' => ['label' => 'Bobot', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'id_kriteria' => $id_kriteria,
                    'nama_subkriteria' => $this->request->getPost('nama_subkriteria'),
                    'bobot' => $this->request->getPost('bobot'),
                ];
                $this->subkriteria->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil ditambahkan</div>');
                return redirect()->to('subkriteria/' . $id_kriteria);
            }

            return redirect()->back()->withInput();
        }

        return view('subkriteria/tambah', $data);
    }

    public function ubah($id_kriteria, $id)
    {
        $data['subkriteria'] = $this->subkriteria->where('id_subkriteria', $id)->first();
        $data['id_kriteria'] = $id_kriteria;

        if ($this->request->getPost()) {
            $this->validation->setRules([
                'nama_subkriteria' => ['label' => 'Nama Subkriteria', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'bobot' => ['label' => 'Bobot', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'id_subkriteria' => $id,
                    'id_kriteria' => $id_kriteria,
                    'nama_subkriteria' => $this->request->getPost('nama_subkriteria'),
                    'bobot' => $this->request->getPost('bobot'),
                ];
                $this->subkriteria->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil diubah</div>');
                return redirect()->to('subkriteria/' . $id_kriteria);
            }

            return redirect()->back()->withInput();
        }

        return view('subkriteria/ubah', $data);
    }

    public function hapus($id_kriteria, $id)
    {
        $this->subkriteria->delete($id);
        session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil dihapus</div>');

        return redirect()->to('subkriteria/' . $id_kriteria);
    }
}

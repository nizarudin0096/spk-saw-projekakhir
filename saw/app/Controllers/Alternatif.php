<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlternatifKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\SubkriteriaModel;

class Alternatif extends BaseController
{
    protected $alternatif;
    protected $alternatif_kriteria;
    protected $kriteria;
    protected $subkriteria;
    protected $validation;

    public function __construct()
    {
        helper('form');
        $this->alternatif = new AlternatifModel();
        $this->alternatif_kriteria = new AlternatifKriteriaModel();
        $this->kriteria = new KriteriaModel();
        $this->subkriteria = new SubkriteriaModel();
        $this->validation = service('validation');
    }

    public function index()
    {
        $data['alternatif'] = $this->alternatif->findAll();

        return view('alternatif/data', $data);
    }

    public function tambah()
    {
        $data['kriteria'] = $this->kriteria->findAll();
        foreach ($data['kriteria'] as $row) {
            $subkriteria = $this->subkriteria->where('id_kriteria', $row['id_kriteria'])->findAll();
            $data['sub'][$row['id_kriteria']] = empty($subkriteria) ? '' : $subkriteria;
        }

        if ($this->request->getPost()) {
            $this->validation->setRules([
                'kode_alternatif' => ['label' => 'Kode Alternatif', 'rules' => ['required', 'is_unique[alternatif.kode_alternatif]'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah ada']],
                'nama_alternatif' => ['label' => 'Nama Alternatif', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'kode_alternatif' => $this->request->getPost('kode_alternatif'),
                    'nama_alternatif' => $this->request->getPost('nama_alternatif'),
                ];
                $this->alternatif->save($params);

                foreach ($data['kriteria'] as $row) {
                    $params = [
                        'id_alternatif' => $this->alternatif->getInsertID(),
                        'id_kriteria' => $row['id_kriteria'],
                        'id_subkriteria' => $this->request->getPost('kriteria' . $row['id_kriteria']),
                    ];
                    $this->alternatif_kriteria->save($params);
                }

                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil ditambahkan</div>');
                return redirect('alternatif');
            }

            return redirect()->back()->withInput();
        }

        return view('alternatif/tambah', $data);
    }

    public function ubah($id)
    {
        $data['alternatif'] = $this->alternatif->where('id_alternatif', $id)->first();
        $data['kriteria'] = $this->kriteria->findAll();
        foreach ($data['kriteria'] as $row) {
            $subkriteria = $this->subkriteria->where('id_kriteria', $row['id_kriteria'])->findAll();
            $data['sub'][$row['id_kriteria']] = empty($subkriteria) ? '' : $subkriteria;

            $alt = $this->alternatif_kriteria->where('id_kriteria', $row['id_kriteria'])
                ->where('id_alternatif', $id)->first();
            $data['alt'][$row['id_kriteria']] = empty($alt) ? '' : $alt['id_subkriteria'];
        }

        if ($this->request->getPost()) {
            $this->validation->setRules([
                'kode_alternatif' => ['label' => 'Kode Alternatif', 'rules' => ['required', 'is_unique[alternatif.kode_alternatif,id_alternatif,' . $id . ']'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah ada']],
                'nama_alternatif' => ['label' => 'Nama Alternatif', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'id_alternatif' => $id,
                    'kode_alternatif' => $this->request->getPost('kode_alternatif'),
                    'nama_alternatif' => $this->request->getPost('nama_alternatif'),
                ];
                $this->alternatif->save($params);

                foreach ($data['kriteria'] as $row) {
                    $alt = $this->alternatif_kriteria->where('id_kriteria', $row['id_kriteria'])
                        ->where('id_alternatif', $id)->first();

                    $params = [
                        'id_alternatif_kriteria' => empty($alt) ? null : $alt['id_alternatif_kriteria'],
                        'id_alternatif' => $id,
                        'id_kriteria' => $row['id_kriteria'],
                        'id_subkriteria' => $this->request->getPost('kriteria' . $row['id_kriteria']),
                    ];
                    $this->alternatif_kriteria->save($params);
                }

                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil diubah</div>');
                return redirect('alternatif');
            }

            return redirect()->back()->withInput();
        }

        return view('alternatif/ubah', $data);
    }

    public function detail($id)
    {
        $data['alternatif'] = $this->alternatif->find($id);
        $data['kriteria'] = $this->kriteria->findAll();
        foreach ($data['kriteria'] as $row) {
            $alt = $this->alternatif_kriteria->where('id_kriteria', $row['id_kriteria'])
                ->where('id_alternatif', $id)->first();
            $sub = empty($alt) ? '' : $this->subkriteria->find($alt['id_subkriteria']);
            $data['sub'][$row['id_kriteria']] = empty($sub) ? '' : $sub['nama_subkriteria'];
        }

        return view('alternatif/detail', $data);
    }

    public function hapus($id)
    {
        $this->alternatif->delete($id);
        session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil dihapus</div>');

        return redirect('alternatif');
    }
}

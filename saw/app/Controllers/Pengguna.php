<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Pengguna extends BaseController
{
    protected $pengguna;
    protected $validation;

    public function __construct()
    {
        helper('form');
        $this->pengguna = new PenggunaModel();
        $this->validation = service('validation');
    }

    public function index()
    {
        $data['pengguna'] = $this->pengguna->findAll();

        return view('pengguna/data', $data);
    }

    public function tambah()
    {
        if ($this->request->getPost()) {
            $this->validation->setRules([
                'nama_lengkap' => ['label' => 'Nama Lengkap', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'username' => ['label' => 'Username', 'rules' => ['required', 'is_unique[pengguna.username]'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah digunakan']],
                'password' => ['label' => 'Password', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'level' => ['label' => 'Level', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'level' => $this->request->getPost('level'),
                ];
                $this->pengguna->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil ditambahkan</div>');
                return redirect('pengguna');
            }

            return redirect()->back()->withInput();
        }

        return view('pengguna/tambah');
    }

    public function ubah($id)
    {
        $data['pengguna'] = $this->pengguna->where('id_pengguna', $id)->first();

        if ($this->request->getPost()) {
            $this->validation->setRules([
                'nama_lengkap' => ['label' => 'Nama Lengkap', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'username' => ['label' => 'Username', 'rules' => ['required', 'is_unique[pengguna.username,id_pengguna,' . $id . ']'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah digunakan']],
                'level' => ['label' => 'Level', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'id_pengguna' => $id,
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'username' => $this->request->getPost('username'),
                    'level' => $this->request->getPost('level'),
                ];
                $this->pengguna->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil diubah</div>');
                return redirect('pengguna');
            }

            return redirect()->back()->withInput();
        }

        return view('pengguna/ubah', $data);
    }

    public function hapus($id)
    {
        $this->pengguna->delete($id);
        session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Data berhasil dihapus</div>');

        return redirect('pengguna');
    }

    public function password()
    {
        if ($this->request->getPost()) {
            $this->validation->setRules([
                'password' => ['label' => 'Password Lama', 'rules' => ['required', 'trim', 'pass_lama'], 'errors' => ['required' => '{field} harus diisi']],
                'password_baru' => ['label' => 'Password Baru', 'rules' => ['required', 'trim'], 'errors' => ['required' => '{field} harus diisi']],
                'ulangi' => ['label' => 'Ulangi Password Baru', 'rules' => ['required', 'trim', 'matches[password_baru]'], 'errors' => ['required' => '{field} harus diisi', 'matches' => '{field} tidak sama']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'id_pengguna' => session()->get('id_pengguna'),
                    'password' => password_hash($this->request->getPost('password_baru'), PASSWORD_DEFAULT),
                ];
                $this->pengguna->save($params);
                session()->setFlashdata('pesan', '<div class="alert bg-success" role="alert">Password berhasil diubah</div>');
                return redirect('password');
            }

            return redirect()->back()->withInput();
        }

        return view('pengguna/password');
    }
}

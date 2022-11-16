<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Register extends BaseController
{
    protected $pengguna;
    protected $validation;

    public function __construct()
    {
        if (session()->has('logged_in')) {
            return redirect('home');
        }

        helper('form');
        $this->pengguna = new PenggunaModel();
        $this->validation = service('validation');
    }

    public function index()
    {
        if ($this->request->getPost()) {
            $this->validation->setRules([
                'nama_lengkap' => ['label' => 'Nama Lengkap', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
                'username' => ['label' => 'Username', 'rules' => ['required', 'is_unique[pengguna.username]'], 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah digunakan']],
                'password' => ['label' => 'Password', 'rules' => ['required'], 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $params = [
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'level' => 'User',
                ];

                $this->pengguna->save($params);

                session()->setFlashdata('pesan', '<div class="alert bg-success text-center" role="alert">Registrasi user berhasil</div>');
                return redirect('login');
            }

            return redirect()->back()->withInput();
        }

        return view('register');
    }
}

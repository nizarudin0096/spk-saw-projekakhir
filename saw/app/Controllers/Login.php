<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->has('logged_in')) {
            return redirect('home');
        }

        return view('login');
    }

    public function cek()
    {
        if ($this->request->getPost()) {
            $pengguna = new PenggunaModel();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $query = $pengguna->where('username', $username)->first();
            if (!empty($query)) {
                if (password_verify($password, $query['password'])) {
                    $session_data = array(
                        'id_pengguna' => $query['id_pengguna'],
                        'username' => $query['username'],
                        'level' => $query['level'],
                        'logged_in' => TRUE
                    );
                    session()->set($session_data);

                    return redirect('home');
                } else {
                    session()->setFlashdata('pesan', '<div class="alert bg-danger text-center" role="alert">Username dan Password salah</div>');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('pesan', '<div class="alert bg-danger text-center" role="alert">User tidak terdaftar</div>');
                return redirect()->back()->withInput();
            }
        }

        return redirect('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect('login');
    }
}

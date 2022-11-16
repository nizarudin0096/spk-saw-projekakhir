<?php

namespace App\Rules;

use App\Models\PenggunaModel;

class PassLamaRule
{
    public function pass_lama(string $str, ?string &$error = null): bool
    {
        $pengguna = new PenggunaModel();
        $result = $pengguna->find(session()->get('id_pengguna'));

        if (password_verify($str, $result['password'])) {
            return true;
        } else {
            $error = 'Password Lama salah';
            return false;
        }
    }
}

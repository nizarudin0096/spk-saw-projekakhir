<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->has('logged_in')) {
            return redirect('login');
        }

        return view('home');
    }
}

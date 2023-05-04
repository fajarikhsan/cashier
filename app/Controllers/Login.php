<?php

namespace App\Controllers;

use App\Models\KasirModel;

class Login extends BaseController
{
    private $kasirModel;

    public function __construct()
    {
        $this->kasirModel = new KasirModel();
    }

    public function index()
    {
        // index
        return view('login/index');
    }

    public function cekLogin()
    {
        $data = $this->kasirModel->where('username', $this->request->getVar('username'))->first();
        if (!empty($data)) {
            if (password_verify($this->request->getVar('password'), $data['pass'])) {
                session()->set([
                    'username' => $data['username'],
                    'level' => $data['level'],
                    'id_user' => $data['id_kasir']
                ]);
                return redirect()->to(base_url("home"));
            } else {
                session()->setFlashdata('login-gagal', 'Password salah.');
                return redirect()->to(base_url());
            }
        } else {
            session()->setFlashdata('login-gagal', 'Username atau Password salah.');
            return redirect()->to(base_url());
        }
    }
}

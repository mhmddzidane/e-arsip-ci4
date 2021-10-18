<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->AuthModel = new AuthModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Login',
        );
        return view('v_login', $data);
    }

    public function login()
    {
        if ($this->validate([
            'email' => [
                'label'  => 'e-mail',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'password' => [
                'label'  => 'password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
        ])) {
            //jika valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->AuthModel->login($email, $password);
            if ($cek) {
                session()->set('log', true);
                session()->set('nama_user', $cek['nama_user']);
                session()->set('email', $cek['email']);
                session()->set('level', $cek['level']);
                session()->set('foto', $cek['foto']);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashData('pesan', 'Login Gagal, Username atau Password Salah!');
                return redirect()->to(base_url('auth/index'));
            }
        } else {
            session()->setFlashData('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/index'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('level');
        session()->remove('foto');

        session()->setFlashData('pesan', 'Anda telah Logout');
        return redirect()->to(base_url('auth/index'));
    }
}

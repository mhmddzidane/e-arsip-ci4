<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DeptModel;

class User extends BaseController
{

    public function __construct()
    {
        $this->ModelUser = new UserModel();
        $this->ModelDept = new DeptModel();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'User',
            'user' => $this->ModelUser->tampil_data(),
            'isi' => 'user/v_index'
        );
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add User',
            'dept' => $this->ModelDept->tampil_data(),
            'isi' => 'user/v_add'
        );
        return view('layout/v_wrapper', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'email' => [
                'label'  => 'E-mail',
                'rules'  => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                    'is_unique' => '{field} Sudah ada, Input {field} lain',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'level' => [
                'label'  => 'Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'id_dept' => [
                'label'  => 'Departemen',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'foto' => [
                'label'  => 'Foto',
                'rules'  => 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/png,image/jpg]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!!',
                    'max_size' => 'Ukuran {field} Maximal 1Mb',
                    'mime_in' => 'Format {field} Wajib PNG atau JPG',
                ],
            ],
        ])) {
            //jika valid

            //mengambil file foto yang akan di upload di form
            $foto = $this->request->getFile('foto');
            //merandom nama file foto
            $nama_file = $foto->getRandomName();
            $data = array(
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
                'id_dept' => $this->request->getPost('id_dept'),
                'foto' => $nama_file,
            );

            $foto->move('foto', $nama_file); //directory upload file
            $this->ModelUser->tambah_data($data);
            session()->setFlashData('pesan', 'Data berhasil ditambah');
            return redirect()->to(base_url('user'));
        } else {
            //jika tidak valid
            session()->setFlashData('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }

    public function edit($id_user)
    {
        $data = array(
            'title' => 'Edit User',
            'dept' => $this->ModelDept->tampil_data(),
            'user' => $this->ModelUser->detail_data($id_user),
            'isi' => 'user/v_edit'
        );
        return view('layout/v_wrapper', $data);
    }

    public function update($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'level' => [
                'label'  => 'Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'id_dept' => [
                'label'  => 'Departemen',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!!',
                ],
            ],
            'foto' => [
                'label'  => 'Foto',
                'rules'  => 'max_size[foto, 1024]|mime_in[foto,image/png,image/jpg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} Maximal 1Mb',
                    'mime_in' => 'Format {field} Wajib PNG atau JPG',
                ],
            ],

        ])) {
            $foto = $this->request->getFile('foto');
            //jika tidak update foto
            if ($foto->getError() == 4) {
                $data = array(
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_dept' => $this->request->getPost('id_dept'),
                    //'foto' => $nama_file,
                );

                //$foto->move('foto', $nama_file); //directory upload file
                $this->ModelUser->edit_data($data);
            } else {
                //hapus foto lama
                $user = $this->ModelUser->detail_data($id_user);
                if ($user['foto'] != "") {
                    unlink('foto/' . $user['foto']);
                }
                //jika update ada
                $nama_file = $foto->getRandomName();
                $data = array(
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_dept' => $this->request->getPost('id_dept'),
                    'foto' => $nama_file,
                );

                $foto->move('foto', $nama_file); //directory upload file
                $this->ModelUser->edit_data($data);
            }

            session()->setFlashData('pesan', 'Data berhasil diupdate');
            return redirect()->to(base_url('user'));
        } else {
            //jika tidak valid
            session()->setFlashData('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/edit' . $id_user));
        }
    }

    public function delete($id_user)
    {
        //hapus foto lama
        $user = $this->ModelUser->detail_data($id_user);
        if ($user['foto'] != "") {
            unlink('foto/' . $user['foto']);
        }
        $data = array(
            'id_user' => $id_user,
        );
        $this->ModelUser->hapus_data($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('user'));
    }
}

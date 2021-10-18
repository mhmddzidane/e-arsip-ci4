<?php

namespace App\Controllers;

use App\Models\DeptModel;

class Dept extends BaseController
{
    public function __construct()
    {
        $this->ModelDept = new DeptModel();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'Departemen',
            'dept' => $this->ModelDept->tampil_data(),
            'isi' => 'v_dept'
        );
        return view('layout/v_wrapper', $data);
    }

    public function tambah_data()
    {
        $data = array('nama_dept' => $this->request->getPost('nama_dept'));
        $this->ModelDept->tambah_data($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('Dept'));
    }

    public function edit_data($id_Dept)
    {
        $data = array(
            'id_dept' => $id_Dept,
            'nama_dept' => $this->request->getPost('nama_dept')
        );
        $this->ModelDept->edit_data($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('Dept'));
    }

    public function hapus_data($id_Dept)
    {
        $data = array(
            'id_dept' => $id_Dept,
        );
        $this->ModelDept->hapus_data($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('Dept'));
    }
}

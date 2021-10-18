<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->ModelCategory = new CategoryModel();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'Kategori',
            'kategori' => $this->ModelCategory->tampil_data(),
            'isi' => 'v_category'
        );
        return view('layout/v_wrapper', $data);
    }

    public function tambah_data()
    {
        $data = array('nama_kategori' => $this->request->getPost('nama_kategori'));
        $this->ModelCategory->tambah_data($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('category'));
    }

    public function edit_data($id_category)
    {
        $data = array(
            'id_kategori' => $id_category,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        );
        $this->ModelCategory->edit_data($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('category'));
    }

    public function hapus_data($id_category)
    {
        $data = array(
            'id_kategori' => $id_category,
        );
        $this->ModelCategory->hapus_data($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('category'));
    }
}

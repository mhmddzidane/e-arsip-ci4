<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    public function tampil_data()
    {
        return $this->db->table("tbl_kategori")->orderBy('id_kategori', 'DESC')->get()->getResultArray();
    }

    public function tambah_data($data)
    {
        $this->db->table('tbl_kategori')->insert($data);
    }

    public function edit_data($data)
    {
        $this->db->table('tbl_kategori')->where('id_kategori', $data['id_kategori'])->update($data);
    }

    public function hapus_data($data)
    {
        $this->db->table('tbl_kategori')->where('id_kategori', $data['id_kategori'])->delete($data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    public function tampil_data()
    {
        return $this->db->table("tbl_arsip")
            ->join('tbl_dept', 'tbl_dept.id_dept = tbl_arsip.id_dept', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->orderBy('id_arsip', 'DESC')
            ->get()->getResultArray();
    }

    public function detail_data($id_arsip)
    {
        return $this->db->table("tbl_arsip")
            ->join('tbl_dept', 'tbl_dept.id_dept = tbl_arsip.id_dept', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->where('id_arsip', $id_arsip)
            ->get()->getRowArray();
    }

    public function tambah_data($data)
    {
        $this->db->table('tbl_arsip')->insert($data);
    }

    public function edit_data($data)
    {
        $this->db->table('tbl_arsip')->where('id_arsip', $data['id_arsip'])->update($data);
    }

    public function hapus_data($data)
    {
        $this->db->table('tbl_arsip')->where('id_arsip', $data['id_arsip'])->delete($data);
    }
}

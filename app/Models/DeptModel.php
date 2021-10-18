<?php

namespace App\Models;

use CodeIgniter\Model;

class DeptModel extends Model
{
    public function tampil_data()
    {
        return $this->db->table("tbl_dept")->orderBy('id_dept', 'DESC')->get()->getResultArray();
    }

    public function tambah_data($data)
    {
        $this->db->table('tbl_dept')->insert($data);
    }

    public function edit_data($data)
    {
        $this->db->table('tbl_dept')->where('id_dept', $data['id_dept'])->update($data);
    }

    public function hapus_data($data)
    {
        $this->db->table('tbl_dept')->where('id_dept', $data['id_dept'])->delete($data);
    }
}

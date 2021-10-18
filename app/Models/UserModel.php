<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function tampil_data()
    {
        return $this->db->table("tbl_user")
            ->join('tbl_dept', 'tbl_dept.id_dept = tbl_user.id_dept', 'left')
            ->orderBy('id_user', 'DESC')
            ->get()->getResultArray();
    }

    public function detail_data($id_user)
    {
        return $this->db->table("tbl_user")
            ->join('tbl_dept', 'tbl_dept.id_dept = tbl_user.id_dept', 'left')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    public function tambah_data($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    public function edit_data($data)
    {
        $this->db->table('tbl_user')->where('id_user', $data['id_user'])->update($data);
    }

    public function hapus_data($data)
    {
        $this->db->table('tbl_user')->where('id_user', $data['id_user'])->delete($data);
    }
}

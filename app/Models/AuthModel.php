<?php 
 
 namespace App\Models;

 use CodeIgniter\Model;

 class AuthModel extends Model
 {
    public function login($email, $password)
    {
        return $this->db->table('tbl_user')->where([
            'email' => $email,
            'password' => $password,
        ])->get()->getRowArray();
    }
 }

<?php

namespace App\Controllers;

use App\Models\ArsipModel;

class Arsip extends BaseController
{
    public function __construct()
    {
        $this->Model_Arsip = new ArsipModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Arsip',
            'arsip' => $this->Model_Arsip->tampil_data(),
            'isi' => 'arsip/v_index'
        );
        return view('layout/v_wrapper', $data);
    }
}

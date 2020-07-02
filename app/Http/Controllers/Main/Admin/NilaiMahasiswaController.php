<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Disposisi;
use App\Data;


class NilaiMahasiswaController extends MainController
{
    public function view ()
    {
        return $this->customView('admin.nilai-mahasiswa', [
            'nav_item_active' => 'nilai-mahasiswa',
            'subtitle' => 'Nilai Mahasiswa',
        ]);
    }
}

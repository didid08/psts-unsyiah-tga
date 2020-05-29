<?php

namespace App\Http\Controllers\Main\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;

use App\User;
use App\Bidang;

class MahasiswaController extends MainController
{
    public function inputDataTGA()
    {
        return $this->customView('mahasiswa.input-data-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Input Data TGA',

            'nama' => User::data('nama'),
            'nim' => User::data('nomor_induk'),

            'semua_dosen' => User::dataWithCategory('dosen'),
            'semua_bidang' => Bidang::get()
        ]);
    }

    public function administrasiTGA()
    {
        return $this->customView('mahasiswa.administrasi-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Administrasi TGA'
        ]);
    }
}

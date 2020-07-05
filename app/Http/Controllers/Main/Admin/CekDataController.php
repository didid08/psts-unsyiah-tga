<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Data;
use App\Disposisi;

class CekDataController extends MainController
{
    public function view()
    {
    	return $this->customView('admin.cek-data', [
            'nav_item_active' => 'cek-data',
            'subtitle' => 'Cek Data',
            'semua_mahasiswa' => User::dataWithCategory('mahasiswa'),
            'check_data' => [
                'foto' => false,
                'khs' => false,
                'krs' => false,
                'transkrip-sementara' => false,
                'spp' => false,

                'buku-proposal' => false,
                'berita-acara-seminar-proposal' => false,
                'daftar-hadir-seminar-proposal' => false,
                'sk-pembimbing' => false,

                'buku-tga' => false,
                'berita-acara-sidang-buku' => false,
                'kelengkapan-dokumen-administrasi-sidang-buku' => false,
                'sk-penguji-sempro' => false,

                'sk-penguji-sidang' => false,
            ],
            'progress' => 0
        ]);
    }

    public function viewWithData(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'nim' => 'required|not_in:empty'
        ], [
        	'required' => 'NIM tidak boleh kosong',
        	'not_in' => 'Harap pilih NIM terlebih dahulu'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $mhs_id = User::where(['nomor_induk' => $request->input('nim')])->first()->id;

        $check_data = [];
        $data_to_check = [
            'foto',
            'khs',
            'krs',
            'transkrip-sementara',
            'spp',

            'buku-proposal',
            'berita-acara-seminar-proposal',
            'daftar-hadir-seminar-proposal',
            'sk-pembimbing',

            'buku-tga',
            'berita-acara-sidang-buku',
            'kelengkapan-dokumen-administrasi-sidang-buku',
            'sk-penguji-sempro',

            'sk-penguji-sidang',
        ];

        foreach ($data_to_check as $value) {
            $d = Data::where(['user_id' => $mhs_id, 'name' => $value]);
            if ($d->exists()) {
                if ($d->first()->verified == true) {
                    $check_data[$value] = true;
                } else {
                    $check_data[$value] = false;
                }
            } else {
                $check_data[$value] = false;
            }
        }

        if (User::where('nomor_induk', $request->input('nim'))->exists()) {
            return $this->customView('admin.cek-data', [
                'nav_item_active' => 'cek-data',
                'subtitle' => 'Cek Data',
                'semua_mahasiswa' => User::dataWithCategory('mahasiswa'),
                'mhs' => User::firstWhere('nomor_induk', $request->input('nim')),
                'progress' => Disposisi::where('user_id', $mhs_id)->first()->progress,
                'check_data' => $check_data
            ]);
        }
        return redirect(route('main.dashboard'))->with('error', 'Data tidak ditemukan');
    }
}

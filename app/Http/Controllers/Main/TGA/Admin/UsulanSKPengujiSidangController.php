<?php

namespace App\Http\Controllers\Main\TGA\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;

class UsulanSKPengujiSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-sk-penguji-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan SK Penguji Sidang',

            'semua_mahasiswa' => Disposisi::where('progress', 24)->orderBy('updated_at')->get(),
            'jumlah_asistensi_2' => $data->getDataMultiple('jumlah-asistensi-2'),
            'masa_pembimbingan_buku_tga' => $data->getDataMultiple('masa-pembimbingan-buku-tga'),
            'lembar_asistensi_2' => $data->getDataMultiple('lembar-asistensi-2'),
            'draft_buku_tga' => $data->getDataMultiple('draft-buku-tga')
        ]);
    }

    public function process($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$validate_rules = [
            'sk-penguji-sidang' => 'required|file|mimes:pdf|max:5120',
            'undangan-sidang' => 'required|file|mimes:pdf|max:5120',
            'berkas-sidang-lainnya' => 'required|file|mimes:pdf|max:5120'
        ];
        $validate_errors = [
            'sk-penguji-sidang.required' => 'Harap unggah SK Penguji Sidang',
            'sk-penguji-sidang.mimes' => 'Harap unggah dalam format pdf',
            'sk-penguji-sidang.max' => 'Ukuran SK Penguji Sidang melebihi 5 MB',

            'undangan-sidang.required' => 'Harap unggah Undangan Sidang',
            'undangan-sidang.mimes' => 'Harap unggah dalam format pdf',
            'undangan-sidang.max' => 'Ukuran Undangan Sidang melebihi 5 MB',

            'berkas-sidang-lainnya.required' => 'Harap unggah Berkas Sidang Lainnya',
            'berkas-sidang-lainnya.mimes' => 'Harap unggah dalam format pdf',
            'berkas-sidang-lainnya.max' => 'Ukuran Berkas Sidang Lainnya melebihi 5 MB'
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $filename1 = $nim.'-sk-penguji-sidang.'.$request->file('sk-penguji-sidang')->extension();
        $filename2 = $nim.'-undangan-sidang.'.$request->file('undangan-sidang')->extension();
        $filename3 = $nim.'-berkas-sidang-lainnya.'.$request->file('berkas-sidang-lainnya')->extension();
        
        $request->file('sk-penguji-sidang')->storeAs(
            'data', $filename1
        );
        $request->file('undangan-sidang')->storeAs(
            'data', $filename2
        );
        $request->file('berkas-sidang-lainnya')->storeAs(
            'data', $filename3
        );

        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul_sidang_buku',
            'type' => 'file',
            'name' => 'sk-penguji-sidang',
            'display_name' => 'SK Penguji Sidang'
        ], [
            'content' => $filename1
        ]);
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul_sidang_buku',
            'type' => 'file',
            'name' => 'undangan-sidang',
            'display_name' => 'Undangan Sidang Buku TGA'
        ], [
            'content' => $filename2
        ]);
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul_sidang_buku',
            'type' => 'file',
            'name' => 'berkas-sidang-lainnya',
            'display_name' => 'Berkas Sidang Lainnya'
        ], [
            'content' => $filename3
        ]);

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	
        $disposisi->update([
            'progress' => 25
        ]);

        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    }
}

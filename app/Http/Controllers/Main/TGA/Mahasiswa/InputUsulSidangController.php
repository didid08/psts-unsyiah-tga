<?php

namespace App\Http\Controllers\Main\TGA\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Disposisi;
use App\Data;

class InputUsulSidangController extends MainController
{
    public function view ()
    {
    	$progress = Disposisi::firstWhere('user_id', User::myData('id'))->progress;
    	
    	if ($progress < 21) {
    		return redirect()->back()->with('error', 'Anda belum menyelesaikan tahap 10');
    	}

    	$data = new Data();

    	$input_value = [
            'jumlah-asistensi-2' => $data->getSingleData(User::myData('id'), 'jumlah-asistensi-2')->content,
            'masa-pembimbingan-buku-tga' => $data->getSingleData(User::myData('id'), 'masa-pembimbingan-buku-tga')->content
        ];

        return $this->customView('tga.mahasiswa.input-usul-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Input Usul Sidang',
            'input_value' => $input_value,
            'progress' => $progress
        ]);
    }

    public function process (Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'lembar-asistensi-2' => 'required|file|mimes:pdf|max:5120',
    		'draft-buku-tga' => 'required|file|mimes:pdf|max:5120'
    	], [
    		'lembar-asistensi-2.required' => 'Harap unggah Lembar Asistensi',
            'lembar-asistensi-2.mimes' => 'Lembar Asistensi yang anda unggah tidak berbentuk pdf',
            'lembar-asistensi-2.max' => 'Ukuran Lembar Asistensi melebihi 5 MB',
            'draft-buku-tga.required' => 'Harap unggah Draft Buku TGA',
            'draft-buku-tga.mimes' => 'Draft Buku TGA yang anda unggah tidak berbentuk pdf',
            'draft-buku-tga.max' => 'Ukuran Draft Buku TGA melebihi 5 MB'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $lembar_asistensi_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-lembar-asistensi-2.'.$request->file('lembar-asistensi-2')->extension();
        $draft_buku_tga_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-draft-buku-tga.'.$request->file('draft-buku-tga')->extension();
        
        $request->file('lembar-asistensi-2')->storeAs(
            'data', $lembar_asistensi_filename
        );
        $request->file('draft-buku-tga')->storeAs(
            'data', $draft_buku_tga_filename
        );

        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_usul_sidang_buku',
            'type' => 'file',
            'name' => 'lembar-asistensi-2',
            'display_name' => 'Lembar Asistensi Buku TGA'
        ], [
            'content' => $lembar_asistensi_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_usul_sidang_buku',
            'type' => 'file',
            'name' => 'draft-buku-tga',
            'display_name' => 'Draft Buku TGA'
        ], [
            'content' => $draft_buku_tga_filename
        ]);

        Disposisi::where('user_id', User::myData('id'))->update([
            'progress' => 22
        ]);

        return redirect(route('main.tga.disposisi'))->with('success', 'Data usul sidang berhasil disimpan');
    }
}

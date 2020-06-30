<?php

namespace App\Http\Controllers\Main\TGA\PembimbingCo;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Data;
use App\Disposisi;
use App\User;

class PersetujuanSeminarDanSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();
    	$user = new User();

    	return $this->customView('tga.pembimbing-co.persetujuan-seminar-dan-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Persetujuan Seminar dan Sidang',

            'semua_mahasiswa' => Data::where(['name' => 'pembimbing', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 7)
            						->orderBy('updated_at')
            						->get(),
            'semua_mahasiswa_2' => Data::where(['name' => 'pembimbing', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 20)
            						->orderBy('updated_at')
            						->get(),
           	'semua_mahasiswa_3' => Data::where(['name' => 'pembimbing', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 32)
            						->orderBy('updated_at')
            						->get(),
            'sk_penguji_sidang' => $data->getDataMultiple('sk-penguji-sidang'),
            'lembar_pengesahan' => $data->getDataMultiple('lembar-pengesahan'),
            'buku_tga' => $data->getDataMultiple('buku-tga'),
        ]);
    }

    public function process($nim, $type, $opsi = null, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        if ($type == 'proposal') {

	        $validate_rules = [
	            'jumlah-asistensi' => 'required|numeric|min:8',
	            'masa-pembimbingan-proposal' => 'required|numeric'
	        ];
	        $validate_errors = [
	            'jumlah-asistensi.required' => 'Harap tetapkan Jumlah Asistensi',
	            'jumlah-asistensi.numeric' => 'Jumlah Asistensi hanya berbentuk angka',
	            'jumlah-asistensi.min' => 'Minimal jumlah asistensi sebanyak 8 kali',
	            'masa-pembimbingan-proposal.required' => 'Harap tetapkan Masa Pembimbingan Proposal',
	            'masa-pembimbingan-proposal.numeric' => 'Masa Pembimbingan Proposal hanya berbentuk angka',
	        ];

	        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator);
	        }

	        Data::updateOrCreate([
	            'user_id' => $user->first()->id,
	            'category' => 'data_usul',
	            'type' => 'text',
	            'name' => 'jumlah-asistensi',
	            'display_name' => 'Jumlah Asistensi'
	        ], [
	            'content' => $request->input('jumlah-asistensi'),
	            'verified' => true
	        ]);

	        Data::updateOrCreate([
	            'user_id' => $user->first()->id,
	            'category' => 'data_usul',
	            'type' => 'text',
	            'name' => 'masa-pembimbingan-proposal',
	            'display_name' => 'Masa Pembimbingan Proposal'
	        ], [
	            'content' => $request->input('masa-pembimbingan-proposal'),
	            'verified' => true
	        ]);

	        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);

	        $disposisi->update([
	            'progress' => 8
	        ]);

	        return redirect()->back()->with('success', 'Data disimpan');
	    } elseif ($type == 'buku-tga') {

	        $validate_rules = [
	            'jumlah-asistensi-2' => 'required|numeric|min:8',
	            'masa-pembimbingan-buku-tga' => 'required|numeric'
	        ];
	        $validate_errors = [
	            'jumlah-asistensi-2.required' => 'Harap tetapkan Jumlah Asistensi',
	            'jumlah-asistensi-2.numeric' => 'Jumlah Asistensi hanya berbentuk angka',
	            'jumlah-asistensi-2.min' => 'Minimal jumlah asistensi sebanyak 8 kali',
	            'masa-pembimbingan-buku-tga.required' => 'Harap tetapkan Masa Pembimbingan Buku TGA',
	            'masa-pembimbingan-buku-tga.numeric' => 'Masa Pembimbingan Buku TGA hanya berbentuk angka',
	        ];

	        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator);
	        }

	        Data::updateOrCreate([
	            'user_id' => $user->first()->id,
	            'category' => 'data_usul_sidang_buku',
	            'type' => 'text',
	            'name' => 'jumlah-asistensi-2',
	            'display_name' => 'Jumlah Asistensi Buku TGA'
	        ], [
	            'content' => $request->input('jumlah-asistensi-2'),
	            'verified' => true
	        ]);

	        Data::updateOrCreate([
	            'user_id' => $user->first()->id,
	            'category' => 'data_usul_sidang_buku',
	            'type' => 'text',
	            'name' => 'masa-pembimbingan-buku-tga',
	            'display_name' => 'Masa Pembimbingan Buku TGA'
	        ], [
	            'content' => $request->input('masa-pembimbingan-buku-tga'),
	            'verified' => true
	        ]);

	        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);

	        $disposisi->update([
	            'progress' => 21
	        ]);

	        return redirect()->back()->with('success', 'Data disimpan');
	    } elseif ($type == 'lembar-pengesahan') {

	    	if ($opsi == 'decline') {
	    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
		        $disposisi->update([
		            'progress' => 31
		        ]);

		        return redirect()->back()->with('error', 'Data ditolak');
	    	} elseif ($opsi == 'accept') {
	    		Data::where(['user_id' => $user->first()->id, 'name' => 'lembar-pengesahan'])->update([
	    			'verified' => true
	    		]);
	    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
		        $disposisi->update([
		            'progress' => 33
		        ]);

		        return redirect()->back()->with('success', 'Data diterima');
	    	}
	    }
    }
}

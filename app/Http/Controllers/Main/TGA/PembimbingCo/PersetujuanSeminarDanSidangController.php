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
            						->get()
        ]);
    }

    public function process($nim, $type, Request $request)
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
	    }
    }
}
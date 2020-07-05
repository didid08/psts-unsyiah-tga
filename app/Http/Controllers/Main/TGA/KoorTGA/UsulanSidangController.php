<?php

namespace App\Http\Controllers\Main\TGA\KoorTGA;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Mail\UsulKomisiPenguji2;

class UsulanSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	// Hapus Komisi Penguji jika sudah lewat 7 hari
    	$daftar_ketua_penguji_array = json_decode(json_encode($data->getDataMultiple('ketua-penguji-2')), true);
    	foreach($daftar_ketua_penguji_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-sidang'])->delete();
		        }
		    }
    	}

    	$daftar_penguji_1_array = json_decode(json_encode($data->getDataMultiple('penguji-1-2')), true);
    	foreach($daftar_penguji_1_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-sidang'])->delete();
		        }
		    }
    	}

    	$daftar_penguji_2_array = json_decode(json_encode($data->getDataMultiple('penguji-2-2')), true);
    	foreach($daftar_penguji_2_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-sidang'])->delete();
		        }
		    }
    	}

    	$daftar_penguji_3_array = json_decode(json_encode($data->getDataMultiple('penguji-3-2')), true);
    	foreach($daftar_penguji_3_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-sidang'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-sidang'])->delete();
		        }
		    }
    	}

    	return $this->customView('tga.koor-tga.usulan-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Sidang',

            'semua_mahasiswa' => Disposisi::where('progress', 23)->orderBy('updated_at')->get(),
            'jumlah_asistensi_2' => $data->getDataMultiple('jumlah-asistensi-2'),
            'masa_pembimbingan_buku_tga' => $data->getDataMultiple('masa-pembimbingan-buku-tga'),
            'lembar_asistensi_2' => $data->getDataMultiple('lembar-asistensi-2'),
            'draft_buku_tga' => $data->getDataMultiple('draft-buku-tga'),
            'semua_dosen' => User::dataWithCategory('dosen'),
            'daftar_ketua_penguji_2' => $data->getDataMultiple('ketua-penguji-2'),
            'daftar_penguji_1_2' => $data->getDataMultiple('penguji-1-2'),
            'daftar_penguji_2_2' => $data->getDataMultiple('penguji-2-2'),
            'daftar_penguji_3_2' => $data->getDataMultiple('penguji-3-2'),
            'jam_sidang' => $data->getDataMultiple('jam-sidang'),
            'tgl_sidang' => $data->getDataMultiple('tgl-sidang'),
            'tempat_sidang' => $data->getDataMultiple('tempat-sidang'),
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);

    	if ($opsi == 'decline')
    	{
    		$disposisi->update([
                'progress' => 21
            ]);
            return redirect()->back()->with('error', 'Usulan telah ditolak');
    	}
    	 elseif ($opsi == 'usulkan-komisi-penguji')
    	{
    		$validator = Validator::make($request->all(), [
	    		'ketua-penguji-2' => 'required',
	    		'penguji-1-2' => 'required',
	    		'penguji-2-2' => 'required',
	    		'penguji-3-2' => 'required',
	    		'jam-sidang' => 'required',
	    		'tgl-sidang' => 'required',
	    		'tempat-sidang' => 'required',
	    	], [
	    		'ketua-penguji-2.required' => 'Harap pilih nama pimpinan',
	    		'penguji-1-2.required' => 'Harap pilih nama penguji 1',
	    		'penguji-2-2.required' => 'Harap pilih nama penguji 2',
	    		'penguji-3-2.required' => 'Harap pilih nama penguji 3',
	    		'jam-sidang.required' => 'Harap tetapkan jam sidang',
	    		'tgl-sidang.required' => 'Harap tetapkan tanggal sidang',
	    		'tempat-sidang.required' => 'Harap tetapkan tempat sidang',
	    	]);

	    	if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator);
	        }

	        $input = [
	        	'ketua-penguji-2' => $request->input('ketua-penguji-2'),
	        	'penguji-1-2' => $request->input('penguji-1-2'),
	        	'penguji-2-2' => $request->input('penguji-2-2'),
	        	'penguji-3-2' => $request->input('penguji-3-2'),
	        	'jam-sidang' => $request->input('jam-sidang'),
	        	'tgl-sidang' => $request->input('tgl-sidang'),
	        	'tempat-sidang' => $request->input('tempat-sidang')
	        ];

	        $komisi_penguji = [
	        	User::where('nomor_induk', $input['ketua-penguji-2'])->first(),
	        	User::where('nomor_induk', $input['penguji-1-2'])->first(),
	        	User::where('nomor_induk', $input['penguji-2-2'])->first(),
	        	User::where('nomor_induk', $input['penguji-3-2'])->first(),
	        ];

	        if ($komisi_penguji[0]->email == null) {
	    		return redirect()->back()->with('error', 'Ketua Penguji tidak memiliki email yang dapat dikirim');
	    	}
	    	if ($komisi_penguji[1]->email == null) {
	    		return redirect()->back()->with('error', 'Penguji 1 tidak memiliki email yang dapat dikirim');
	    	}
	    	if ($komisi_penguji[2]->email == null) {
	    		return redirect()->back()->with('error', 'Penguji 2 tidak memiliki email yang dapat dikirim');
	    	}
	    	if ($komisi_penguji[3]->email == null) {
	    		return redirect()->back()->with('error', 'Penguji 3 tidak memiliki email yang dapat dikirim');
	    	}

	    	$key = [
	    		uniqid(rand()),
	    		uniqid(rand()),
	    		uniqid(rand()),
	    		uniqid(rand())
	    	];

	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'ketua-penguji-2',
	    		'display_name' => 'Pimpinan Sidang Buku TGA'
	    	], [
	    		'content' => $komisi_penguji[0]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[0])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'penguji-1-2',
	    		'display_name' => 'Penguji 1 Sidang Buku TGA'
	    	], [
	    		'content' => $komisi_penguji[1]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[1])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'penguji-2-2',
	    		'display_name' => 'Penguji 2 Sidang Buku TGA'
	    	], [
	    		'content' => $komisi_penguji[2]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[2])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'penguji-3-2',
	    		'display_name' => 'Penguji 3 Sidang Buku TGA'
	    	], [
	    		'content' => $komisi_penguji[3]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[3])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'jam-sidang',
	    		'display_name' => 'Jam Sidang'
	    	], [
	    		'content' => $input['jam-sidang'],
	    		'verified' => false
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'tgl-sidang',
	    		'display_name' => 'Tanggal Sidang'
	    	], [
	    		'content' => $input['tgl-sidang'],
	    		'verified' => false
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sidang_buku',
	    		'type' => 'text',
	    		'name' => 'tempat-sidang',
	    		'display_name' => 'Tempat Sidang'
	    	], [
	    		'content' => $input['tempat-sidang'],
	    		'verified' => false
	    	]);

	    	Mail::to($komisi_penguji[0]->email)->send(new UsulKomisiPenguji2($user->first()->nama, $user->first()->nomor_induk, $input['jam-sidang'], $input['tgl-sidang'], $input['tempat-sidang'], $key[0], 'ketua-penguji'));
	    	Mail::to($komisi_penguji[1]->email)->send(new UsulKomisiPenguji2($user->first()->nama, $user->first()->nomor_induk, $input['jam-sidang'], $input['tgl-sidang'], $input['tempat-sidang'], $key[1], 'penguji-1'));
	    	Mail::to($komisi_penguji[2]->email)->send(new UsulKomisiPenguji2($user->first()->nama, $user->first()->nomor_induk, $input['jam-sidang'], $input['tgl-sidang'], $input['tempat-sidang'], $key[2], 'penguji-2'));
	    	Mail::to($komisi_penguji[3]->email)->send(new UsulKomisiPenguji2($user->first()->nama, $user->first()->nomor_induk, $input['jam-sidang'], $input['tgl-sidang'], $input['tempat-sidang'], $key[3], 'penguji-3'));

	    	return redirect()->back()->with('success', 'Berhasil mengusulkan Komisi Penguji untuk '.$user->first()->nama.' ('.$nim.')');
    	}

    	 elseif ($opsi == 'tetapkan-komisi-penguji')
		{
			Data::where(['user_id' => $user->first()->id, 'name' => 'lembar-asistensi-2'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'draft-buku-tga'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'jam-sidang'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'tgl-sidang'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'tempat-sidang'])->update([
				'verified' => true
			]);

			$disposisi->update([
				'progress' => 24
			]);

            return redirect()->back()->with('success', 'Komisi penguji dan jadwal sidang berhasil ditetapkan');
        }
    	return abort(404);
    }
}

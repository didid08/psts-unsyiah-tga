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
use App\Mail\UsulKomisiPenguji;

class UsulanSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	// Hapus Komisi Penguji jika sudah lewat 7 hari
    	$daftar_ketua_penguji_array = json_decode(json_encode($data->getDataMultiple('ketua-penguji')), true);
    	foreach($daftar_ketua_penguji_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-seminar'])->delete();
		        }
		    }
    	}

    	$daftar_penguji_1_array = json_decode(json_encode($data->getDataMultiple('penguji-1')), true);
    	foreach($daftar_penguji_1_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-seminar'])->delete();
		        }
		    }
    	}

    	$daftar_penguji_2_array = json_decode(json_encode($data->getDataMultiple('penguji-2')), true);
    	foreach($daftar_penguji_2_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-seminar'])->delete();
		        }
		    }
    	}

    	$daftar_penguji_3_array = json_decode(json_encode($data->getDataMultiple('penguji-3')), true);
    	foreach($daftar_penguji_3_array as $index => $value) {
    		if ($value['verified'] == false) {
	    		$diff = time() - strtotime($value['updated_at']);
		        $hariLewat = floor($diff / (60 * 60 * 24));
		        if ($hariLewat >= 7) {
		            Data::where(['user_id' => $value['user_id'], 'name' => 'ketua-penguji'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-1'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-2'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'penguji-3'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'jam-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tgl-seminar'])->delete();
		            Data::where(['user_id' => $value['user_id'], 'name' => 'tempat-seminar'])->delete();
		        }
		    }
    	}

    	return $this->customView('tga.koor-tga.usulan-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 10)->orderBy('updated_at')->get(),
            'jumlah_asistensi' => $data->getDataMultiple('jumlah-asistensi'),
            'masa_pembimbingan_proposal' => $data->getDataMultiple('masa-pembimbingan-proposal'),
            'lembar_asistensi' => $data->getDataMultiple('lembar-asistensi'),
            'draft_buku_proposal' => $data->getDataMultiple('draft-buku-proposal'),
            'semua_dosen' => User::dataWithCategory('dosen'),
            'daftar_ketua_penguji' => $data->getDataMultiple('ketua-penguji'),
            'daftar_penguji_1' => $data->getDataMultiple('penguji-1'),
            'daftar_penguji_2' => $data->getDataMultiple('penguji-2'),
            'daftar_penguji_3' => $data->getDataMultiple('penguji-3'),
            'jam_seminar' => $data->getDataMultiple('jam-seminar'),
            'tgl_seminar' => $data->getDataMultiple('tgl-seminar'),
            'tempat_seminar' => $data->getDataMultiple('tempat-seminar'),
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
                'progress' => 8
            ]);
            return redirect()->back()->with('error', 'Usulan telah ditolak');
    	}
    	 elseif ($opsi == 'usulkan-komisi-penguji')
    	{
    		$validator = Validator::make($request->all(), [
	    		'ketua-penguji' => 'required',
	    		'penguji-1' => 'required',
	    		'penguji-2' => 'required',
	    		'penguji-3' => 'required',
	    		'jam-seminar' => 'required',
	    		'tgl-seminar' => 'required',
	    		'tempat-seminar' => 'required',
	    	], [
	    		'ketua-penguji.required' => 'Harap pilih nama pimpinan',
	    		'penguji-1.required' => 'Harap pilih nama penguji 1',
	    		'penguji-2.required' => 'Harap pilih nama penguji 2',
	    		'penguji-3.required' => 'Harap pilih nama penguji 3',
	    		'jam-seminar.required' => 'Harap tetapkan jam seminar',
	    		'tgl-seminar.required' => 'Harap tetapkan tanggal seminar',
	    		'tempat-seminar.required' => 'Harap tetapkan tempat seminar',
	    	]);

	    	if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator);
	        }

	        $input = [
	        	'ketua-penguji' => $request->input('ketua-penguji'),
	        	'penguji-1' => $request->input('penguji-1'),
	        	'penguji-2' => $request->input('penguji-2'),
	        	'penguji-3' => $request->input('penguji-3'),
	        	'jam-seminar' => $request->input('jam-seminar'),
	        	'tgl-seminar' => $request->input('tgl-seminar'),
	        	'tempat-seminar' => $request->input('tempat-seminar')
	        ];

	        $komisi_penguji = [
	        	User::where('nomor_induk', $input['ketua-penguji'])->first(),
	        	User::where('nomor_induk', $input['penguji-1'])->first(),
	        	User::where('nomor_induk', $input['penguji-2'])->first(),
	        	User::where('nomor_induk', $input['penguji-3'])->first(),
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
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'ketua-penguji',
	    		'display_name' => 'Pimpinan Seminar'
	    	], [
	    		'content' => $komisi_penguji[0]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[0])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'penguji-1',
	    		'display_name' => 'Penguji 1'
	    	], [
	    		'content' => $komisi_penguji[1]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[1])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'penguji-2',
	    		'display_name' => 'Penguji 2'
	    	], [
	    		'content' => $komisi_penguji[2]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[2])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'penguji-3',
	    		'display_name' => 'Penguji 3'
	    	], [
	    		'content' => $komisi_penguji[3]->nama,
	    		'verified' => false,
	    		'verification_key' => Hash::make($key[3])
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'jam-seminar',
	    		'display_name' => 'Jam Seminar'
	    	], [
	    		'content' => $input['jam-seminar'],
	    		'verified' => false
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'tgl-seminar',
	    		'display_name' => 'Tanggal Seminar'
	    	], [
	    		'content' => $input['tgl-seminar'],
	    		'verified' => false
	    	]);
	    	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul_sempro',
	    		'type' => 'text',
	    		'name' => 'tempat-seminar',
	    		'display_name' => 'Tempat Seminar'
	    	], [
	    		'content' => $input['tempat-seminar'],
	    		'verified' => false
	    	]);

	    	Mail::to($komisi_penguji[0]->email)->send(new UsulKomisiPenguji($user->first()->nama, $user->first()->nomor_induk, $input['jam-seminar'], $input['tgl-seminar'], $input['tempat-seminar'], $key[0], 'ketua-penguji'));
	    	Mail::to($komisi_penguji[1]->email)->send(new UsulKomisiPenguji($user->first()->nama, $user->first()->nomor_induk, $input['jam-seminar'], $input['tgl-seminar'], $input['tempat-seminar'], $key[1], 'penguji-1'));
	    	Mail::to($komisi_penguji[2]->email)->send(new UsulKomisiPenguji($user->first()->nama, $user->first()->nomor_induk, $input['jam-seminar'], $input['tgl-seminar'], $input['tempat-seminar'], $key[2], 'penguji-2'));
	    	Mail::to($komisi_penguji[3]->email)->send(new UsulKomisiPenguji($user->first()->nama, $user->first()->nomor_induk, $input['jam-seminar'], $input['tgl-seminar'], $input['tempat-seminar'], $key[3], 'penguji-3'));

	    	return redirect()->back()->with('success', 'Berhasil mengusulkan Komisi Penguji untuk '.$user->first()->nama.' ('.$nim.')');
    	}

    	 elseif ($opsi == 'tetapkan-komisi-penguji')
		{
			Data::where(['user_id' => $user->first()->id, 'name' => 'lembar-asistensi'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'draft-buku-proposal'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'jam-seminar'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'tgl-seminar'])->update([
				'verified' => true
			]);
			Data::where(['user_id' => $user->first()->id, 'name' => 'tempat-seminar'])->update([
				'verified' => true
			]);

			$disposisi->update([
				'progress' => 11
			]);

            return redirect()->back()->with('success', 'Komisi penguji dan jadwal seminar berhasil ditetapkan');
        }
    	return abort(404);
    }
}

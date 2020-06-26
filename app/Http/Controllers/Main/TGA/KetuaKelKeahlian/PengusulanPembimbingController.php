<?php

namespace App\Http\Controllers\Main\TGA\KetuaKelKeahlian;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Data;
use App\Disposisi;
use App\User;
use App\Mail\UsulPembimbing;
use App\Mail\UsulCoPembimbing;

class PengusulanPembimbingController extends MainController
{
    public function view()
    {
    	$data = new Data();
    	$user = new User();

    	$dosen_pembimbing = [];
    	$dosen_co_pembimbing = [];

    	foreach (User::where('category', 'dosen')->get() as $dosen) {
    		if ($user->calculateBimbingan('total')[$dosen->nama] < 10) {
    			$dosen_pembimbing[$dosen->nomor_induk] = $dosen->nama;
    		}
    	}
    	foreach (User::where('category', 'dosen')->get() as $dosen) {
    		if ($user->calculateCoBimbingan('total')[$dosen->nama] < 10) {
    			$dosen_co_pembimbing[$dosen->nomor_induk] = $dosen->nama;
    		}
    	}

    	$mhsYgSudahAdaPembimbingCo = [];

    	return $this->customView('tga.ketua-kel-keahlian.pengusulan-pembimbing', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Pengusulan Pembimbing dan Co',

            'semua_mahasiswa' => Data::where(['name' => 'ketua-bidang', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 4)
            						->orderBy('updated_at')
            						->get(),
            'daftar_pembimbing' => $data->getDataMultiple('pembimbing'),
            'daftar_co_pembimbing' => $data->getDataMultiple('co-pembimbing'),
            'judul_tga' => $data->getDataMultiple('judul-tga'),
            'dosen_pembimbing' => $dosen_pembimbing,
            'dosen_co_pembimbing' => $dosen_co_pembimbing
        ]);
    }

    public function usul($nim, Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'pembimbing' => 'required',
    		'co-pembimbing' => 'required'
    	], [
    		'pembimbing.required' => 'Harap pilih nama pembimbing',
    		'co-pembimbing.required' => 'Harap pilih nama co pembimbing'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

    	$nomorIndukPembimbing = $request->input('pembimbing');
    	$nomorIndukCoPembimbing = $request->input('co-pembimbing');

    	if ($nomorIndukPembimbing == 'empty' | $nomorIndukCoPembimbing == 'empty') {
    		return redirect()->back()->with('error', 'Harap pilih nama pembimbing beserta co pembimbing');
    	}

    	$mahasiswa = User::where('nomor_induk', $nim)->first();
    	$pembimbing = User::where('nomor_induk', $nomorIndukPembimbing)->first();
    	$coPembimbing = User::where('nomor_induk', $nomorIndukCoPembimbing)->first();

    	if ($pembimbing->email == null) {
    		return redirect()->back()->with('error', 'Pembimbing tidak memiliki email yang dapat dikirim');
    	}

    	if ($coPembimbing->email == null) {
    		return redirect()->back()->with('error', 'Co Pembimbing tidak memiliki email yang dapat dikirim');
    	}

    	$key1 = uniqid(rand());
    	$key2 = uniqid(rand());

    	Data::updateOrCreate([
    		'user_id' => $mahasiswa->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pembimbing',
    		'display_name' => 'Nama Pembimbing'
    	], [
    		'content' => $pembimbing->nama,
    		'verified' => false,
    		'verification_key' => Hash::make($key1)
    	]);

    	Data::updateOrCreate([
    		'user_id' => $mahasiswa->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'co-pembimbing',
    		'display_name' => 'Nama Co Pembimbing'
    	], [
    		'content' => $coPembimbing->nama,
    		'verified' => false,
    		'verification_key' => Hash::make($key2)
    	]);

    	Mail::to($pembimbing->email)->send(new UsulPembimbing($mahasiswa->nama, $mahasiswa->nomor_induk, $key1));
    	Mail::to($coPembimbing->email)->send(new UsulCoPembimbing($mahasiswa->nama, $mahasiswa->nomor_induk, $key2));

    	return redirect()->back()->with('success', 'Berhasil mengusulkan Pembimbing dan Co Pembimbing untuk '.$mahasiswa->nama.' ('.$nim.')');
    }
}

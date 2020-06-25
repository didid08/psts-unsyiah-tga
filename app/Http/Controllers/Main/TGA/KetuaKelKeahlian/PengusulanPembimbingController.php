<?php

namespace App\Http\Controllers\Main\TGA\KetuaKelKeahlian;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    	return $this->customView('tga.ketua-kel-keahlian.tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'TGA',

            'semua_mahasiswa' => Data::where(['name' => 'ketua-bidang', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 4)
            						->orderBy('updated_at')
            						->get(),
            'judul_tga' => $data->getDataMultiple('judul-tga'),
            'dosen_pembimbing' => $dosen_pembimbing,
            'dosen_co_pembimbing' => $dosen_co_pembimbing
        ]);
    }

    public function usul($nim, Request $request)
    {
    	$this->validate($request, [
    		'pembimbing' => 'required',
    		'co-pembimbing' => 'required'
    	]);

    	$nomorIndukPembimbing = $request->input('pembimbing');
    	$nomorIndukCoPembimbing = $request->input('co-pembimbing');

    	if ($nomorIndukPembimbing == 'empty' | $nomorIndukCoPembimbing == 'empty') {
    		return redirect()->back()->with('error', 'Harap masukkan nama pembimbing beserta co pembimbing');
    	}

    	$mahasiswa = User::where('nomor_induk', $nim)->first();
    	$pembimbing = User::where('nomor_induk', $nomorIndukPembimbing)->first();
    	$coPembimbing = User::where('nomor_induk', $nomorIndukCoPembimbing)->first();

    	Data::updateOrCreate([
    		'user_id' => $mahasiswa->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pembimbing',
    		'display_name' => 'Nama Pembimbing'
    	], [
    		'content' => $pembimbing->nama
    	]);

    	Data::updateOrCreate([
    		'user_id' => $mahasiswa->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'co-pembimbing',
    		'display_name' => 'Nama Co Pembimbing'
    	], [
    		'content' => $coPembimbing->nama
    	]);

    	Mail::to($pembimbing->email)->send(new UsulPembimbing($mahasiswa->nama, $mahasiswa->nomor_induk));
    	Mail::to($coPembimbing->email)->send(new UsulCoPembimbing($mahasiswa->nama, $mahasiswa->nomor_induk));

    	return redirect()->back()->with('success', 'Berhasil mengusulkan Pembimbing dan Co Pembimbing untuk '.$mahasiswa->nama.' ('.$nim.')');
    }
}

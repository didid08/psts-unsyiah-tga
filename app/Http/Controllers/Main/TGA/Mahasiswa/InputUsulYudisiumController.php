<?php

namespace App\Http\Controllers\Main\TGA\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Disposisi;
use App\Data;

class InputUsulYudisiumController extends MainController
{
    public function view ()
    {
        $data = new Data;
    	$progress = Disposisi::firstWhere('user_id', User::myData('id'))->progress;
    	
    	if ($progress < 33) {
    		return redirect()->back()->with('error', 'Anda belum menyelesaikan tahap 15');
    	}

        return $this->customView('tga.mahasiswa.input-usul-yudisium', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Input Usul Yudisium',
            'progress' => $progress,
            'cek_berkas_yudisium' => $data->checkMultipleData(User::myData('id'), ['biodata', 'transkrip', 'bukti-bebas-lab', 'artikel-jim'])
        ]);
    }

    public function process (Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'biodata' => 'required|file|mimes:pdf|max:5120',
    		'transkrip' => 'required|file|mimes:pdf|max:5120',
            'bukti-bebas-lab' => 'required|file|mimes:pdf|max:5120',
            'artikel-jim' => 'required|file|mimes:pdf|max:5120'
    	], [
    		'biodata.required' => 'Harap unggah Biodata',
            'biodata.mimes' => 'Biodata yang anda unggah tidak berbentuk pdf',
            'biodata.max' => 'Ukuran Biodata melebihi 5 MB',

            'transkrip.required' => 'Harap unggah Transkrip',
            'transkrip.mimes' => 'Transkrip yang anda unggah tidak berbentuk pdf',
            'transkrip.max' => 'Ukuran Transkrip melebihi 5 MB',

            'bukti-bebas-lab.required' => 'Harap unggah Bukti Bebas Lab',
            'bukti-bebas-lab.mimes' => 'Bukti Bebas Lab yang anda unggah tidak berbentuk pdf',
            'bukti-bebas-lab.max' => 'Ukuran Bukti Bebas Lab melebihi 5 MB',

            'artikel-jim.required' => 'Harap unggah Artikel JIM',
            'artikel-jim.mimes' => 'Artikel JIM yang anda unggah tidak berbentuk pdf',
            'artikel-jim.max' => 'Ukuran Artikel JIM melebihi 5 MB'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $biodata_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-biodata.'.$request->file('biodata')->extension();
        $transkrip_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-transkrip.'.$request->file('transkrip')->extension();
        $bukti_bebas_lab_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-bukti-bebas-lab.'.$request->file('bukti-bebas-lab')->extension();
        $artikel_jim_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-artikel-jim.'.$request->file('artikel-jim')->extension();
        
        $request->file('biodata')->storeAs(
            'data', $biodata_filename
        );
        $request->file('transkrip')->storeAs(
            'data', $transkrip_filename
        );
        $request->file('bukti-bebas-lab')->storeAs(
            'data', $bukti_bebas_lab_filename
        );
        $request->file('artikel-jim')->storeAs(
            'data', $artikel_jim_filename
        );

        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'biodata',
            'display_name' => 'Biodata'
        ], [
            'content' => $biodata_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'transkrip',
            'display_name' => 'Transkrip'
        ], [
            'content' => $transkrip_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'bukti-bebas-lab',
            'display_name' => 'Bukti Bebas Lab'
        ], [
            'content' => $bukti_bebas_lab_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'artikel-jim',
            'display_name' => 'Artikel JIM'
        ], [
            'content' => $artikel_jim_filename
        ]);

        return redirect(route('main.tga.disposisi'))->with('success', 'Data yudisium berhasil disimpan');
    }
}

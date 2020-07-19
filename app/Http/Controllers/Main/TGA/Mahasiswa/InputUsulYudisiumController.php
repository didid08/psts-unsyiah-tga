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
            'cek_berkas_yudisium' => $data->checkMultipleData(User::myData('id'), ['berkas-1', 'berkas-2', 'berkas-3', 'berkas-4'])
        ]);
    }

    public function process (Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'berkas-1' => 'required|file|mimes:pdf|max:5120',
    		'berkas-2' => 'required|file|mimes:pdf|max:5120',
            'berkas-3' => 'required|file|mimes:pdf|max:5120',
            'berkas-4' => 'required|file|mimes:pdf|max:5120'
    	], [
    		'berkas-1.required' => 'Harap unggah Berkas 1',
            'berkas-1.mimes' => 'Berkas 1 yang anda unggah tidak berbentuk pdf',
            'berkas-1.max' => 'Ukuran Berkas 1 melebihi 5 MB',

            'berkas-2.required' => 'Harap unggah Berkas 2',
            'berkas-2.mimes' => 'Berkas 2 yang anda unggah tidak berbentuk pdf',
            'berkas-2.max' => 'Ukuran Berkas 2 melebihi 5 MB',

            'berkas-3.required' => 'Harap unggah Berkas 3',
            'berkas-3.mimes' => 'Berkas 3 yang anda unggah tidak berbentuk pdf',
            'berkas-3.max' => 'Ukuran Berkas 3 melebihi 5 MB',

            'berkas-4.required' => 'Harap unggah Berkas 4',
            'berkas-4.mimes' => 'Berkas 4 yang anda unggah tidak berbentuk pdf',
            'berkas-4.max' => 'Ukuran Berkas 4 melebihi 5 MB'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $berkas_1_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-berkas-1.'.$request->file('berkas-1')->extension();
        $berkas_2_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-berkas-2.'.$request->file('berkas-2')->extension();
        $berkas_3_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-berkas-3.'.$request->file('berkas-3')->extension();
        $berkas_4_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-berkas-4.'.$request->file('berkas-4')->extension();
        
        $request->file('berkas-1')->storeAs(
            'data', $berkas_1_filename
        );
        $request->file('berkas-2')->storeAs(
            'data', $berkas_2_filename
        );
        $request->file('berkas-3')->storeAs(
            'data', $berkas_3_filename
        );
        $request->file('berkas-4')->storeAs(
            'data', $berkas_4_filename
        );

        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'berkas-1',
            'display_name' => 'Berkas 1'
        ], [
            'content' => $berkas_1_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'berkas-2',
            'display_name' => 'Berkas 2'
        ], [
            'content' => $berkas_2_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'berkas-3',
            'display_name' => 'Berkas 3'
        ], [
            'content' => $berkas_3_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_yudisium',
            'type' => 'file',
            'name' => 'berkas-4',
            'display_name' => 'Berkas 4'
        ], [
            'content' => $berkas_4_filename
        ]);

        return redirect(route('main.tga.disposisi'))->with('success', 'Data yudisium berhasil disimpan');
    }
}

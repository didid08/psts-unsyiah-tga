<?php

namespace App\Http\Controllers\Main\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Disposisi;
use App\Data;

class BiodataController extends MainController
{
    public function view ()
    {
    	$progress = Disposisi::firstWhere('user_id', User::myData('id'))->progress;
    	
    	if ($progress <= 1) {
    		return redirect()->back()->with('error', 'Harap lengkapi Input Usul TGA');
    	}

    	$data = new Data();
    	$id = User::myData('id');

    	$input_value = [
            'nama' => User::myData('nama'),
            'nim' => User::myData('nomor_induk'),
            'foto' => Data::where(['user_id' => $id, 'name' => 'foto'])->first()->content,
            'tempat-tgl-lahir' => Data::where(['user_id' => $id, 'name' => 'tempat-lahir'])->first()->content.' / '.Carbon::parse(Data::where(['user_id' => $id, 'name' => 'tgl-lahir'])->first()->content)->translatedFormat('d F Y'),
            'agama' => Data::where(['user_id' => $id, 'name' => 'agama'])->first()->content,
            'jenis-kelamin' => Data::where(['user_id' => $id, 'name' => 'gender'])->first()->content,
            'judul-skripsi' => Data::where(['user_id' => $id, 'name' => 'judul-tga'])->first()->content
        ];

        $add_to_input_value = [
        	'tahun-masuk',
        	'asal-smta',
        	'tahun-ijazah-smta',
        	'terdaftar-sebagai-mahasiswa',
        	'bekerja',
        	'kawin',
        	'biaya-pendidikan',
        	'jumlah-saudara-kandung',
        	'yang-sudah-sarjana',
        	'sedang-kuliah',
        	'sedang-sekolah',
        	'nama-ayah',
        	'nama-ibu',
        	'pendidikan-ayah',
        	'pendidikan-ibu',
        	'alamat'
        ];

        foreach ($add_to_input_value as $value) {
        	$query = Data::where(['user_id' => $id, 'name' => $value]);
        	if ($query->exists()) {
        		$input_value[$value] = $query->first()->content;
        	} else {
        		$input_value[$value] = null;
        	}
        }

        return $this->customView('mahasiswa.biodata', [
            'nav_item_active' => 'biodata',
            'subtitle' => 'Biodata',
            'input_value' => $input_value,
            'progress' => $progress
        ]);
    }

    public function process (Request $request)
    {
        $validator_rules = [
            'tahun-masuk' => 'required',
            'asal-smta' => 'required',
            'tahun-ijazah-smta' => 'required',
            'terdaftar-sebagai-mahasiswa' => 'required',
            'bekerja' => 'required',
            'kawin' => 'required',
            'biaya-pendidikan' => 'required',
            'jumlah-saudara-kandung' => 'required',
            'yang-sudah-sarjana' => 'required',
            'sedang-kuliah' => 'required',
            'sedang-sekolah' => 'required',
            'nama-ayah' => 'required',
            'nama-ibu' => 'required',
            'pendidikan-ayah' => 'required',
            'pendidikan-ibu' => 'required',
            'alamat' => 'required'
        ];
    	$validator = Validator::make($request->all(), $validator_rules, [
    		'tahun-masuk.required' => 'Tahun Masuk tidak boleh kosong',
            'asal-smta.required' => 'Asal SMTA tidak boleh kosong',
            'tahun-ijazah-smta.required' => 'Tahun Ijazah SMTA tidak boleh kosong',
            'terdaftar-sebagai-mahasiswa.required' => 'Terdaftar Sebagai Mahasiswa tidak boleh kosong',
            'bekerja.required' => 'Bekerja tidak boleh kosong',
            'kawin.required' => 'Kawin tidak boleh kosong',
            'biaya-pendidikan.required' => 'Biaya Pendidikan tidak boleh kosong',
            'jumlah-saudara-kandung.required' => 'Jumlah Saudara Kandung tidak boleh kosong',
            'yang-sudah-sarjana.required' => 'Yang Sudah Sarjana tidak boleh kosong',
            'sedang-kuliah.required' => 'Sedang Kuliah tidak boleh kosong',
            'sedang-sekolah.required' => 'Sedang Sekolah tidak boleh kosong',
            'nama-ayah.required' => 'Nama Ayah tidak boleh kosong',
            'nama-ibu.required' => 'Nama Ibu tidak boleh kosong',
            'pendidikan-ayah.required' => 'Pendidikan Ayah tidak boleh kosong',
            'pendidikan-ibu.required' => 'Pendidikan Ibu tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        foreach ($validator_rules as $key => $value) {
            Data::updateOrCreate([
                'user_id' => User::myData('id'),
                'category' => 'biodata',
                'type' => 'text',
                'name' => $key,
                'display_name' => ucwords(str_replace('-', ' ', $key))
            ], [
                'content' => $request->input($key),
                'verified' => true
            ]);   
        }

        return redirect(route('main.mahasiswa.biodata'))->with('success', 'Biodata berhasil disimpan');
    }
}

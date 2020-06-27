<?php

namespace App\Http\Controllers\Main\TGA\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Bidang;
use App\Disposisi;
use App\Data;

class InputUsulController extends MainController
{
    public function view()
    {
        $input_value = [
            'bidang'             => null,
            'tempat-lahir'       => null,
            'tgl-lahir'          => null,
            'agama'              => null,
            'gender'             => null,
            'no-hp'              => null,
            'email'              => null,
            'judul-tga'          => null,
            'tahun-ajaran'       => null,
            'pembimbing'         => null,
            'co-pembimbing'      => null,
            'dosen-wali'         => null,
            'ketua-bidang'       => null,
            'dana-pendidikan'    => null,
            'nama-beasiswa'      => null,
            'foto'               => null,
            'no-disposisi'       => Disposisi::where('user_id', User::myData('id'))->first()->no_disposisi,
            'tgl-disposisi'      => null,
            'no-sk-pembimbing'   => null,
            'tgl-sk-pembimbing'  => null,
        ];

        $data_usul = User::find(User::myData('id'))->data()->where('category', 'data_usul');

        if ($data_usul->exists()) {
            foreach ($data_usul->get() as $data) {
                if ($data->verified == true) {
                    if ($data->name == 'sk-pembimbing') {
                        $input_value['no-sk-pembimbing'] = $data->no;
                        $input_value['tgl-sk-pembimbing'] = date('d-m-Y', strtotime($data->tgl));
                    } else {
                        $input_value[$data->name] = $data->content;
                    }
                }
            }
        }

        if (Disposisi::where('user_id', User::myData('id'))->first()->tgl_disposisi != null) {
            $input_value['tgl-disposisi'] = date('d-m-Y', strtotime(Disposisi::where('user_id', User::myData('id'))->first()->tgl_disposisi));
        }

        return $this->customView('tga.mahasiswa.input-usul', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Input Usul TGA',
            'nama' => User::myData('nama'),
            'nim' => User::myData('nomor_induk'),
            'semua_dosen' => User::dataWithCategory('dosen'),
            'semua_bidang' => Bidang::get(),
            'input_value' => $input_value,
            'progress' => Disposisi::firstWhere('user_id', User::myData('id'))->progress
        ]);
    }

    public function process(Request $request)
    {
        $validator_rules = [
            'bidang'             => 'required',
            'tempat-lahir'       => 'required',
            'tgl-lahir'          => 'required|date',
            'agama'              => 'required',
            'gender'             => 'required',
            'no-hp'              => 'required',
            'email'              => 'required|email',
            'judul-tga'          => 'required',
            'tahun-ajaran'       => 'required',
            'dosen-wali'         => 'required',
            'ketua-bidang'       => 'required',
            'dana-pendidikan'    => 'required'
        ];

        $validator_errors = [
            'bidang.required'             => 'Bidang tidak boleh kosong',
            'tempat-lahir.required'       => 'Tempat Lahir tidak boleh kosong',
            'tgl-lahir.required'          => 'Tanggal Lahir tidak boleh kosong',
            'tgl-lahir.date'              => 'Format Tanggal Lahir salah',
            'agama.required'              => 'Agama tidak boleh kosong',
            'gender.required'             => 'Jenis Kelamin tidak boleh kosong',
            'no-hp.required'              => 'Nomor HP tidak boleh kosong',
            'email.required'              => 'Email tidak boleh kosong',
            'email.email'                 => 'Format Email salah',
            'judul-tga.required'          => 'Judul TGA tidak boleh kosong',
            'tahun-ajaran.required'       => 'Tahun Ajaran tidak boleh kosong',
            'dosen-wali.required'         => 'Dosen Wali tidak boleh kosong',
            'ketua-bidang.required'       => 'Ketua Bidang tidak boleh kosong',
            'dana-pendidikan.required'    => 'Dana Pendidikan tidak boleh kosong'
        ];

        if ($request->has('nama-beasiswa')) {
            $validator_rules = array_merge($validator_rules, ['nama-beasiswa' => 'required']);
            $validator_errors = array_merge($validator_errors, ['nama-beasiswa.required' => 'Dana Pendidikan yang dipilih adalah Beasiswa tetapi Nama Beasiswa tidak terisi']);
        }

        $data = new Data;
        $id = User::myData('id');

        if (Disposisi::firstWhere('user_id', $id)->progress == 1) {
            $validator_rules = array_merge($validator_rules, [
                'spp'                 => 'required|file|mimes:pdf|max:5120',
                'krs'                 => 'required|file|mimes:pdf|max:5120',
                'transkrip-sementara' => 'required|file|mimes:pdf|max:5120',
                'khs'                 => 'required|file|mimes:pdf|max:5120',
                'foto'                => 'required|image|mimes:jpeg,png,jpg|max:3072'
            ]);
            $validator_errors = array_merge($validator_errors, [
                'spp.required' => 'SPP tidak boleh kosong',
                'krs.required' => 'KRS tidak boleh kosong',
                'transkrip-sementara.required' => 'Transkrip Sementara tidak boleh kosong',
                'khs.required' => 'KHS tidak boleh kosong',
                'foto.required' => 'Foto tidak boleh kosong',
                'spp.mimes' => 'SPP yang anda unggah tidak berbentuk pdf',
                'krs.mimes' => 'KRS yang anda unggah tidak berbentuk pdf',
                'transkrip-sementara.mimes' => 'Transkrip Sementara yang anda unggah tidak berbentuk pdf',
                'khs.mimes' => 'KHS yang anda unggah tidak berbentuk pdf',
                'foto.mimes' => 'Format foto yang didukung: jpg,jpeg dan png',
                'spp.max' => 'Ukuran SPP melebihi 5 MB',
                'krs.max' => 'Ukuran KRS melebihi 5 MB',
                'transkrip-sementara.max' => 'Ukuran Transkrip Sementara melebihi 5 MB',
                'khs.max' => 'Ukuran KHS melebihi 5 MB',
                'foto.max' => 'Ukuran maksimal foto sebesar 3 MB'
            ]);
        }

        $validator = Validator::make($request->all(), $validator_rules, $validator_errors);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = [];

        foreach ($validator_rules as $index => $value) {
            $input[$index] = $request->input($index);
        }

        foreach ($input as $index => $value) {
            if (in_array($index, ['foto', 'spp', 'krs', 'khs', 'transkrip-sementara']))
            {
                $ext = $request->file($index)->extension();
                $filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-'.$index.'.'.$ext;
                $request->file($index)->storeAs(
                    'data', $filename
                );
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => $index,
                    'display_name' => ucwords(str_replace('-', ' ', $index))
                ], [
                    'content' => $filename
                ]);
            } else {
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'text',
                    'name' => $index,
                    'display_name' => ucwords(str_replace('-', ' ', $index))
                ], [
                    'content' => $value,
                    'verified' => true
                ]);
            }
        }

        if (!array_key_exists('nama-beasiswa', $input)) {
            $nama_beasiswa = User::find(User::myData('id'))->data()->where('name', 'nama-beasiswa');

            if ($nama_beasiswa->exists()) {
                $nama_beasiswa->delete();
            }
        }

        if (array_key_exists('spp', $input) && array_key_exists('krs', $input) && array_key_exists('khs', $input) && array_key_exists('transkrip-sementara', $input) && array_key_exists('foto', $input)) {
            Disposisi::where('user_id', User::myData('id'))->update([
                'progress' => 2
            ]);
            return redirect(route('main.tga.disposisi'))->with('success', 'Data anda berhasil disimpan');            
        }

        return redirect()->back()->with('success', 'Data anda berhasil disimpan');
    }
}

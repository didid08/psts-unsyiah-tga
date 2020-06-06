<?php

namespace App\Http\Controllers\Main\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Bidang;
use App\AdministrasiTGA;
use App\DataTGA;

class MahasiswaController extends MainController
{
    public function inputDataTGA()
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
            'nama-pembimbing'    => null,
            'nama-co-pembimbing' => null,
            'dosen-wali'         => null,
            'ketua-bidang'       => null,
            'dana-pendidikan'    => null,
            'nama-beasiswa'      => null
        ];

        $administrasi_tga = false;

        $data_usul_tga = User::find(User::data('id'))->dataTGA()->where('category', 'data_usul_tga');

        if ($data_usul_tga->exists()) {
            foreach ($data_usul_tga->get() as $data) {
                $input_value[$data->name] = $data->content;
            }
            $administrasi_tga = true;
        }

        return $this->customView('mahasiswa.input-data-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Input Data TGA',

            'nama' => User::data('nama'),
            'nim' => User::data('nomor_induk'),

            'semua_dosen' => User::dataWithCategory('dosen'),
            'semua_bidang' => Bidang::get(),

            'input_value' => $input_value,

            'administrasi_tga' => $administrasi_tga
        ]);
    }

    public function inputDataTGAProcess(Request $request)
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
            'nama-pembimbing'    => 'required',
            'nama-co-pembimbing' => 'required',
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
            'nama-pembimbing.required'    => 'Nama Pembimbing tidak boleh kosong',
            'nama-co-pembimbing.required' => 'Nama Co Pembimbing tidak boleh kosong',
            'dosen-wali.required'         => 'Dosen Wali tidak boleh kosong',
            'ketua-bidang.required'       => 'Ketua Bidang tidak boleh kosong',
            'dana-pendidikan.required'    => 'Dana Pendidikan tidak boleh kosong'
        ];

        if ($request->has('nama-beasiswa')) {
            $validator_rules = array_merge($validator_rules, ['nama-beasiswa' => 'required']);
            $validator_errors = array_merge($validator_errors, ['nama-beasiswa.required' => 'Dana Pendidikan yang dipilih adalah Beasiswa tetapi Nama Beasiswa tidak terisi']);
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
            DataTGA::updateOrCreate([
                'user_id' => User::data('id'),
                'category' => 'data_usul_tga',
                'type' => 'inline',
                'name' => $index,
                'display_name' => ucwords(str_replace('-', ' ', $index))
            ], [
                'content' => $value
            ]);
        }

        if (!array_key_exists('nama-beasiswa', $input)) {
            $nama_beasiswa = User::find(User::data('id'))->dataTGA()->where('name', 'nama-beasiswa');

            if ($nama_beasiswa->exists()) {
                $nama_beasiswa->delete();
            }
        }

        $administrasiTGA = User::find(User::data('id'))->administrasiTGA();
            
        if ($administrasiTGA->exists()) { 
            return redirect()->back()->with('success', 'Data anda berhasil diupdate');
        }

        $administrasi_tga = new AdministrasiTGA;
        $administrasi_tga->user_id = User::data('id');
        $administrasi_tga->tahap = 1;
        $administrasi_tga->disposition = 1;
        $administrasi_tga->save();

        return redirect(route('main.administrasi-tga', ['category' => 'mahasiswa']))->with('success', 'Sekarang anda dapat mengajukan data Administrasi TGA');
    }
}

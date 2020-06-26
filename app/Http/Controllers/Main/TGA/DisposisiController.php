<?php

namespace App\Http\Controllers\Main\TGA;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class DisposisiController extends MainController
{
    public function view($nim = null)
    {
        $userRole = new UserRole();
        $role = $userRole->myRoles();

        if (isset($role->mhs)) {
            if ($nim == null) {

                $id = User::myData('id');
                $data = new Data();
                
                return $this->customView('tga.disposisi.main', [
                    'nav_item_active' => 'tga',
                    'subtitle' => 'Disposisi',
                    'role' => $role,
                    'mahasiswa' => User::where('id', $id)->first(),
                    'disposisi' => Disposisi::where('user_id', $id)->first(),
                    'data' => $data->listData($id)
                ]);
            }
            return abort(404);
        } else {

            $extra_data = [];

            // Cek Mahasiswa
            if ($nim != null) {

                $mahasiswa = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);

                // Apakah Mahasiswa dengan NIM tsb tidak ada?
                if (!$mahasiswa->exists()) {
                    return abort(404);
                }

                $mhs_id = User::firstWhere('nomor_induk', $nim)->id;
                $user_role = new UserRole ();
                $my_roles = $user_role->myRoles();

                $data = new Data ();
                $user = new User;
                $daftar_bimbingan = $user->calculateBimbingan('total');
                $daftar_co_bimbingan = $user->calculateCoBimbingan('total');
                $semua_dosen_bimbingan = [];
                $semua_dosen_co_bimbingan = [];
                foreach (User::dataWithCategory('dosen') as $x) {
                    if ($daftar_bimbingan[$x->nama] < 10) {
                        array_push($semua_dosen_bimbingan, $x);
                    }
                }
                foreach (User::dataWithCategory('dosen') as $x) {
                    if ($daftar_co_bimbingan[$x->nama] < 10) {
                        array_push($semua_dosen_co_bimbingan, $x);
                    }
                }

                $extra_data = [
                    'mahasiswa' => User::firstWhere('nomor_induk', $nim),
                    'mahasiswa_data_tga' => $data->listData($mhs_id),
                    'roles' => $my_roles,
                    'disposisi' => Disposisi::where('user_id', $mhs_id)->first(),
                    'data' => $data->listData($mhs_id),
                    'semua_dosen' => User::dataWithCategory('dosen'),
                    'semua_dosen_bimbingan' => json_decode(json_encode($semua_dosen_bimbingan)),
                    'semua_dosen_co_bimbingan' => json_decode(json_encode($semua_dosen_co_bimbingan))
                ];

            } else {
                $extra_data['disposisi'] = Disposisi::orderBy('user_id')->get();
            }

            return $this->customView('tga.disposisi.main', array_merge([
                'nav_item_active' => 'tga',
                'subtitle' => 'Disposisi',
                'nim' => $nim
            ], $extra_data));
        }
    }

    public function upload($category, $nim, $progress, Request $request)
    {
        $validator = Validator::make($request->all(), $this->uploadValidation($progress)['rules'], $this->uploadValidation($progress)['errors']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = [];
        $file = [];

        foreach ($this->uploadValidation($progress)['rules'] as $index => $value) {
            if (strpos($value, 'file')) {
                $file[$index] = $request->file($index);
            } else {
                $input[$index] = $request->input($index);
            }
        }

        dd($file);
    }

    public function uploadValidation($progress)
    {
        $validate_rules = [];
        $validate_errors = [];

        switch ($progress) {
            case '1':
                $validate_rules = [
                    'spp' => 'required|file|mimes:pdf|max:5120',
                    'krs' => 'required|file|mimes:pdf|max:5120',
                    'transkrip-sementara' => 'required|file|mimes:pdf|max:5120',
                    'khs' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'spp.required' => 'SPP tidak ditemukan',
                    'krs.required' => 'KRS tidak ditemukan',
                    'transkrip-sementara.required' => 'Transkrip Sementara tidak ditemukan',
                    'khs.required' => 'KHS tidak ditemukan',

                    'spp.mimes' => 'SPP yang anda unggah tidak berbentuk pdf',
                    'krs.mimes' => 'KRS yang anda unggah tidak berbentuk pdf',
                    'transkrip-sementara.mimes' => 'Transkrip Sementara yang anda unggah tidak berbentuk pdf',
                    'khs.mimes' => 'KHS yang anda unggah tidak berbentuk pdf',

                    'spp.max' => 'Ukuran SPP melebihi 5 MB',
                    'krs.max' => 'Ukuran KRS melebihi 5 MB',
                    'transkrip-sementara.max' => 'Ukuran Transkrip Sementara melebihi 5 MB',
                    'khs.max' => 'Ukuran KHS melebihi 5 MB'
                ];
            break;

            case 'optional-1':
                $validate_rules = [
                    'sptpd' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'sptpd.required' => 'Berkas tidak ditemukan',
                    'sptpd.mimes' => 'Berkas yang anda unggah tidak berbentuk pdf',
                    'sptpd.max' => 'Ukuran berkas melebihi 5 MB'
                ];
            break;

            case '8':
                $validate_rules = [
                    'lembar-asistensi' => 'required|file|mimes:pdf|max:5120',
                    'draft-buku-proposal' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'lembar-asistensi.required' => 'Lembar Asistensi tidak ditemukan',
                    'lembar-asistensi.mimes' => 'Lembar Asistensi yang anda unggah tidak berbentuk pdf',
                    'lembar-asistensi.max' => 'Ukuran Lembar Asistensi melebihi 5 MB',

                    'draft-buku-proposal.required' => 'Draft Buku Proposal tidak ditemukan',
                    'draft-buku-proposal.mimes' => 'Draft Buku Proposal yang anda unggah tidak berbentuk pdf',
                    'draft-buku-proposal.max' => 'Ukuran Draft Buku Proposal melebihi 5 MB'
                ];
            break;

            case '15':
                $validate_rules = [
                    'berita-acara-seminar-proposal' => 'required|file|mimes:pdf|max:5120',
                    'buku-proposal' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'berita-acara-seminar-proposal.required' => 'Berita Acara Seminar Proposal tidak ditemukan',
                    'berita-acara-seminar-proposal.mimes' => 'Berita Acara Seminar Proposal yang anda unggah tidak berbentuk pdf',
                    'berita-acara-seminar-proposal.max' => 'Ukuran Berita Acara Seminar Proposal melebihi 5 MB',

                    'buku-proposal.required' => 'Buku Proposal tidak ditemukan',
                    'buku-proposal.mimes' => 'Buku Proposal yang anda unggah tidak berbentuk pdf',
                    'buku-proposal.max' => 'Ukuran Buku Proposal melebihi 5 MB'
                ];
            break;

            case '18':
                $validate_rules = [
                    'kelengkapan-dokumen-administrasi-seminar-proposal' => 'required|file|mimes:zip|max:10240'
                ];
                $validate_errors = [
                    'kelengkapan-dokumen-administrasi-seminar-proposal.required' => 'Berkas tidak ditemukan',
                    'kelengkapan-dokumen-administrasi-seminar-proposal.mimes' => 'Berkas yang anda unggah tidak berbentuk zip',
                    'kelengkapan-dokumen-administrasi-seminar-proposal.max' => 'Ukuran berkas melebihi 10 MB'
                ];
            break;

            case '21':
                $validate_rules = [
                    'lembar-asistensi-2' => 'required|file|mimes:pdf|max:5120',
                    'draft-buku-proposal' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'lembar-asistensi-2.required' => 'Lembar Asistensi tidak ditemukan',
                    'lembar-asistensi-2.mimes' => 'Lembar Asistensi yang anda unggah tidak berbentuk pdf',
                    'lembar-asistensi-2.max' => 'Ukuran Lembar Asistensi melebihi 5 MB',

                    'draft-buku-tga.required' => 'Draft Buku TGA tidak ditemukan',
                    'draft-buku-tga.mimes' => 'Draft Buku TGA yang anda unggah tidak berbentuk pdf',
                    'draft-buku-tga.max' => 'Ukuran Draft Buku TGA melebihi 5 MB'
                ];
            break;

            case '28':
                $validate_rules = [
                    'berita-acara-sidang-buku' => 'required|file|mimes:pdf|max:5120',
                    'buku-tga' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'berita-acara-sidang-buku.required' => 'Berita Acara Sidang Buku tidak ditemukan',
                    'berita-acara-sidang-buku.mimes' => 'Berita Acara Sidang Buku yang anda unggah tidak berbentuk pdf',
                    'berita-acara-sidang-buku.max' => 'Ukuran Berita Acara Sidang Buku melebihi 5 MB',

                    'buku-tga.required' => 'Buku TGA tidak ditemukan',
                    'buku-tga.mimes' => 'Buku TGA yang anda unggah tidak berbentuk pdf',
                    'buku-tga.max' => 'Ukuran Buku TGA melebihi 5 MB'
                ];
            break;

            case '31':
                $validate_rules = [
                    'lembar-pengesahan-dan-buku-laporan-kp' => 'required|file|mimes:zip|max:10240'
                ];
                $validate_errors = [
                    'lembar-pengesahan-dan-buku-laporan-kp.required' => 'Berkas tidak ditemukan',
                    'lembar-pengesahan-dan-buku-laporan-kp.mimes' => 'Berkas yang anda unggah tidak berbentuk zip',
                    'lembar-pengesahan-dan-buku-laporan-kp.max' => 'Ukuran berkas melebihi 10 MB'
                ];
            break;

            case '34':
                $validate_rules = [
                    'kelengkapan-dokumen-administrasi-sidang-buku' => 'required|file|mimes:zip|max:10240',
                    'kelengkapan-dokumen-yudisium-dan-wisuda' => 'required|file|mimes:zip|max:10240'
                ];
                $validate_errors = [
                    'kelengkapan-dokumen-administrasi-sidang-buku.required' => 'Kelengkapan Dokumen Administrasi Sidang Buku tidak ditemukan',
                    'kelengkapan-dokumen-administrasi-sidang-buku.mimes' => 'Kelengkapan Dokumen Administrasi Sidang Buku yang anda unggah tidak berbentuk zip',
                    'kelengkapan-dokumen-administrasi-sidang-buku.max' => 'Ukuran Kelengkapan Dokumen Administrasi Sidang Buku melebihi 10 MB',

                    'kelengkapan-dokumen-yudisium-dan-wisuda.required' => 'Kelengkapan Dokumen Yudisium dan Wisuda tidak ditemukan',
                    'kelengkapan-dokumen-yudisium-dan-wisuda.mimes' => 'Kelengkapan Dokumen Yudisium dan Wisuda yang anda unggah tidak berbentuk zip',
                    'kelengkapan-dokumen-yudisium-dan-wisuda.max' => 'Ukuran Kelengkapan Dokumen Yudisium dan Wisuda melebihi 10 MB'
                ];
            break;

            default:
                return abort(404);
        }

        return ['rules' => $validate_rules, 'errors' => $validate_errors];
    }

    public function changeProgress($nim, $progress, $opsi = null)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if ($user->exists()) {
            $mhsId = $user->first()->id;

            Disposisi::where('user_id', $mhsId)->update([
                'progress' => $progress
            ]);

            if ($opsi == 'verified')
            {
                Data::where('user_id', $mhsId)->update([
                    'verified' => true
                ]);

                if (Disposisi::firstWhere('user_id', $mhsId)->no_disposisi == null
                    && Disposisi::firstWhere('user_id', $mhsId)->tgl_disposisi == null)
                {
                    $jumlahYgAdaNomor = Disposisi::whereNotNull('no_disposisi')->get()->count();
                    $no = $jumlahYgAdaNomor+1;

                    Disposisi::where('user_id', $mhsId)->update([
                        'no_disposisi' => $no.'/TA/II/'.date('Y'),
                        'tgl_disposisi' => date('Y m d')
                    ]);                
                }
            }

            return redirect()->back()->with('success', 'Success');
        }
        return abort(404);
    }

    public function terimaUsul($name, $nim, Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'key' => 'required'
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $mhs = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if ($mhs->exists()) {

            $data = Data::where(['user_id' => $mhs->first()->id, 'name' => $name]);
            if ($data->exists()) {

                if ($data->first()->verified == true) {
                    return abort(404);
                }

                $diff = time() - strtotime($data->first()->updated_at);
                $hariLewat = floor($diff / (60 * 60 * 24));
                if ($hariLewat >= 2) {
                    return abort(404);
                }

                if (Hash::check($request->input('key'), $data->first()->verification_key))
                {
                    $data->update([
                        'verified' => true,
                        'verification_key' => null
                    ]);
                    return response('Anda telah setuju untuk dijadikan '.ucwords(str_replace('-', ' ', $name)).' untuk mahasiswa bernama '.$mhs->first()->nama.' ('.$mhs->first()->nomor_induk.')');
                }
                return abort(404);
            }
            return abort(404);
        }
        return abort(404);
    }
}

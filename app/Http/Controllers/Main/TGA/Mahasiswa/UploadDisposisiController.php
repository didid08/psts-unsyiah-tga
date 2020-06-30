<?php

namespace App\Http\Controllers\Main\TGA\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class UploadDisposisiController extends Controller
{
    public function __invoke($progress, $optional = null, Request $request)
    {
    	$disposisi = Disposisi::where('user_id', User::myData('id'));

    	if ($optional != null) {
    		if ($progress == 1)
    		{
    			$validate_rules = [
                    'sptpd' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'sptpd.required' => 'Harap unggah Surat Permohonan Tugas Pengambilan Data',
                    'sptpd.mimes' => 'Harap unggah dalam format pdf',
                    'sptpd.max' => 'Ukuran Surat Permohonan Tugas Pengambilan Data melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $ext = $request->file('sptpd')->extension();
                $filename = User::myData('nomor_induk').'-sptpd.'.$ext;
                $request->file('sptpd')->storeAs(
                    'data', $filename
                );
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'sptpd',
                    'display_name' => 'Surat Permohonan Tugas Pengambilan Data'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress_optional' => 2
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah Surat Permohonan Tugas Pengambilan Data');
    		}
    	} else {
            if ($progress == 14) {
                $validate_rules = [];
                $validate_errors = [];

                for($i = 1; $i <= 10; $i++) {
                    $validate_rules['peserta-seminar-'.$i.'-nama'] = 'required';
                    $validate_rules['peserta-seminar-'.$i.'-nim'] = 'required|numeric';

                    $validate_errors['peserta-seminar-'.$i.'-nama.required'] = 'Harap masukkan nama peserta nomor '.$i;
                    $validate_errors['peserta-seminar-'.$i.'-nim.required'] = 'Harap masukkan NIM peserta nomor '.$i;
                    $validate_errors['peserta-seminar-'.$i.'-nim.numeric'] = 'Format NIM peserta '.$i.' salah';
                }

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                for($i = 1; $i <= 10; $i++) {
                    Data::updateOrCreate([
                        'user_id' => User::myData('id'),
                        'category' => 'data_usul_sempro',
                        'type' => 'text',
                        'name' => 'peserta-seminar-'.$i,
                        'display_name' => 'Peserta Seminar '.$i
                    ], [
                        'content' => $request->input('peserta-seminar-'.$i.'-nama').'-'.$request->input('peserta-seminar-'.$i.'-nim'),
                        'verified' => true
                    ]);
                }

                $disposisi->update([
                    'progress' => 15
                ]);

                return redirect()->back()->with('success', 'Berhasil mengisi peserta seminar proposal');
            } elseif ($progress == 27) {
                $validate_rules = [];
                $validate_errors = [];

                for($i = 1; $i <= 10; $i++) {
                    $validate_rules['peserta-sidang-'.$i.'-nama'] = 'required';
                    $validate_rules['peserta-sidang-'.$i.'-nim'] = 'required|numeric';

                    $validate_errors['peserta-sidang-'.$i.'-nama.required'] = 'Harap masukkan nama peserta nomor '.$i;
                    $validate_errors['peserta-sidang-'.$i.'-nim.required'] = 'Harap masukkan NIM peserta nomor '.$i;
                    $validate_errors['peserta-sidang-'.$i.'-nim.numeric'] = 'Format NIM peserta '.$i.' salah';
                }

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                for($i = 1; $i <= 10; $i++) {
                    Data::updateOrCreate([
                        'user_id' => User::myData('id'),
                        'category' => 'data_usul_sidang_buku',
                        'type' => 'text',
                        'name' => 'peserta-sidang-'.$i,
                        'display_name' => 'Peserta Sidang '.$i
                    ], [
                        'content' => $request->input('peserta-sidang-'.$i.'-nama').'-'.$request->input('peserta-sidang-'.$i.'-nim'),
                        'verified' => true
                    ]);
                }

                $disposisi->update([
                    'progress' => 28
                ]);

                return redirect()->back()->with('success', 'Berhasil mengisi peserta sidang buku tga');
            } elseif ($progress == 15) {
                $validate_rules = [
                    'berita-acara-seminar-proposal' => 'required|file|mimes:pdf|max:5120',
                    'buku-proposal' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'berita-acara-seminar-proposal.required' => 'Harap unggah Berita Acara Seminar Proposal',
                    'berita-acara-seminar-proposal.mimes' => 'Harap unggah dalam format pdf',
                    'berita-acara-seminar-proposal.max' => 'Ukuran Berita Acara Seminar Proposal melebihi 5 MB',
                    'buku-proposal.required' => 'Harap unggah Buku Proposal',
                    'buku-proposal.mimes' => 'Harap unggah dalam format pdf',
                    'buku-proposal.max' => 'Ukuran Buku Proposal melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename1 = User::myData('nomor_induk').'-berita-acara-seminar-proposal.'.$request->file('berita-acara-seminar-proposal')->extension();
                $filename2 = User::myData('nomor_induk').'-buku-proposal.'.$request->file('buku-proposal')->extension();

                $request->file('berita-acara-seminar-proposal')->storeAs(
                    'data', $filename1
                );
                $request->file('buku-proposal')->storeAs(
                    'data', $filename2
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul_sempro',
                    'type' => 'file',
                    'name' => 'berita-acara-seminar-proposal',
                    'display_name' => 'Berita Acara Seminar Proposal'
                ], [
                    'content' => $filename1
                ]);
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul_sempro',
                    'type' => 'file',
                    'name' => 'buku-proposal',
                    'display_name' => 'Buku Proposal'
                ], [
                    'content' => $filename2
                ]);

                $disposisi->update([
                    'progress' => 16
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah berkas pengesahan seminar proposal');
            } elseif ($progress == 18) {
                $validate_rules = [
                    'daftar-hadir-seminar-proposal' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'daftar-hadir-seminar-proposal.required' => 'Harap unggah Daftar Hadir Seminar Proposal',
                    'daftar-hadir-seminar-proposal.mimes' => 'Harap unggah dalam format pdf',
                    'daftar-hadir-seminar-proposal.max' => 'Ukuran Daftar Hadir Seminar Proposal Proposal melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename = User::myData('nomor_induk').'-daftar-hadir-seminar-proposal.'.$request->file('daftar-hadir-seminar-proposal')->extension();

                $request->file('daftar-hadir-seminar-proposal')->storeAs(
                    'data', $filename
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul_sempro',
                    'type' => 'file',
                    'name' => 'daftar-hadir-seminar-proposal',
                    'display_name' => 'Daftar Hadir Seminar Proposal'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress' => 19
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah Daftar Hadir Seminar Proposal');
            } elseif ($progress == 28) {
                $validate_rules = [
                    'berita-acara-sidang-buku' => 'required|file|mimes:pdf|max:5120',
                    'buku-tga' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'berita-acara-sidang-buku.required' => 'Harap unggah Berita Acara Sidang Buku',
                    'berita-acara-sidang-buku.mimes' => 'Harap unggah dalam format pdf',
                    'berita-acara-sidang-buku.max' => 'Ukuran Berita Acara Sidang Buku melebihi 5 MB',
                    'buku-tga.required' => 'Harap unggah Buku TGA',
                    'buku-tga.mimes' => 'Harap unggah dalam format pdf',
                    'buku-tga.max' => 'Ukuran Buku TGA melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename1 = User::myData('nomor_induk').'-berita-acara-sidang-buku.'.$request->file('berita-acara-sidang-buku')->extension();
                $filename2 = User::myData('nomor_induk').'-buku-tga.'.$request->file('buku-tga')->extension();

                $request->file('berita-acara-sidang-buku')->storeAs(
                    'data', $filename1
                );
                $request->file('buku-tga')->storeAs(
                    'data', $filename2
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul_sidang_buku',
                    'type' => 'file',
                    'name' => 'berita-acara-sidang-buku',
                    'display_name' => 'Berita Acara Sidang Buku'
                ], [
                    'content' => $filename1
                ]);
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul_sidang_buku',
                    'type' => 'file',
                    'name' => 'buku-tga',
                    'display_name' => 'Buku TGA'
                ], [
                    'content' => $filename2
                ]);

                $disposisi->update([
                    'progress' => 29
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah berkas pengesahan sidang');
            }
            return abort(404);
        }
    }
}

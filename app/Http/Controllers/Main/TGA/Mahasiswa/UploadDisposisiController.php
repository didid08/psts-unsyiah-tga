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
    	}
    }
}

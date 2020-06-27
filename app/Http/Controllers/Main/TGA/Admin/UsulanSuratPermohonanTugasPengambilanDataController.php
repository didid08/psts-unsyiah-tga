<?php

namespace App\Http\Controllers\Main\TGA\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class UsulanSuratPermohonanTugasPengambilanDataController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-surat-permohonan-tugas-pengambilan-data', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Surat Permohonan Tugas Pengambilan Data',

            'semua_mahasiswa' => Disposisi::where('progress_optional', 2)->where('progress', '<', 26)->orderBy('updated_at')->get(),
            'sptpd' => $data->getDataMultiple('sptpd')
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);

    	switch ($opsi)
    	{
    		case 'decline':
    			$disposisi->update([
	                'progress_optional' => 1
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':
		    	/*$validate_rules = [
		            'stpd' => 'required|file|mimes:pdf|max:5120'
		        ];
		        $validate_errors = [
		            'stpd.required' => 'Harap unggah Surat Tugas Pengambilan Data',
		            'stpd.mimes' => 'Harap unggah dalam format pdf',
		            'stpd.max' => 'Ukuran Surat Tugas Pengambilan Data melebihi 5 MB'
		        ];

		        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
		        if ($validator->fails()) {
		            return redirect()->back()->withErrors($validator);
		        }

		        $ext = $request->file('stpd')->extension();
		        $filename = $nim.'-stpd.'.$ext;
		        $request->file('stpd')->storeAs(
		            'data', $filename
		        );
		        Data::updateOrCreate([
		            'user_id' => $user->first()->id,
		            'category' => 'data_usul',
		            'type' => 'file',
		            'name' => 'stpd',
		            'display_name' => 'Surat Tugas Pengambilan Data'
		        ], [
		            'content' => $filename
		        ]);

				Data::where(['user_id' => $user->first()->id, 'name' => 'sptpd'])->update([
	                'verified' => true
	            ]);*/

	            $disposisi->update([
                    'progress_optional' => 3
                ]);

                return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    		break;
    		default:
    			return abort(404);
    	}
    	
    }
}

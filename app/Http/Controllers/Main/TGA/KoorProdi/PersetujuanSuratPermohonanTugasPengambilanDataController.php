<?php

namespace App\Http\Controllers\Main\TGA\KoorProdi;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class PersetujuanSuratPermohonanTugasPengambilanDataController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.persetujuan-surat-permohonan-tugas-pengambilan-data', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Persetujuan Surat Permohonan Tugas Pengambilan Data',

            'semua_mahasiswa' => Disposisi::where('progress_optional', 3)->where('progress', '<', 26)->orderBy('updated_at')->get(),
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
    			Data::where(['user_id' => $user->first()->id, 'name' => 'sptpd'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress_optional' => 4
                ]);

                return redirect()->back()->with('success', 'Surat Permohonan Tugas Pengambilan Data telah disetujui');
    		break;
    		default:
    			return abort(404);
    	}
    	
    }
}

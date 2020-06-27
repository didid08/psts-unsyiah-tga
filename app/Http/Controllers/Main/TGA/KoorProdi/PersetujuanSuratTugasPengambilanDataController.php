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

class PersetujuanSuratTugasPengambilanDataController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.persetujuan-surat-tugas-pengambilan-data', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Persetujuan Surat Tugas Pengambilan Data',

            'semua_mahasiswa' => Disposisi::where('progress_optional', 5)->where('progress', '<', 26)->orderBy('updated_at')->get(),
            'stpd' => $data->getDataMultiple('stpd')
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
	                'progress_optional' => 4
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':
    			$jumlahYgAdaNomorStpd = Data::where('name', 'stpd')->whereNotNull('no')->whereNotNull('tgl')->get()->count();
                $noStpd = $jumlahYgAdaNomorStpd+1;

                if (Data::where(['user_id' => $user->first()->id, 'name' => 'stpd'])->first()->no == null) {
                    Data::where(['user_id' => $user->first()->id, 'name' => 'stpd'])->update([
                        'no' => $noStpd.'/TA/II/'.date('Y'),
                        'tgl' => date('Y m d')
                    ]);
                }

    			Data::where(['user_id' => $user->first()->id, 'name' => 'stpd'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress_optional' => 6
                ]);

                return redirect()->back()->with('success', 'Surat Tugas Pengambilan Data telah disetujui');
    		break;
    		default:
    			return abort(404);
    	}	
    }
}

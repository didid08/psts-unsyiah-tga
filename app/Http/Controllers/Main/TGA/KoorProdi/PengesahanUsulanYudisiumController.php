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

class PengesahanUsulanYudisiumController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.pengesahan-usulan-yudisium', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Pengesahan Usulan Yudisium',

            'semua_mahasiswa' => Disposisi::where('progress', 35)->orderBy('updated_at')->get(),
            'biodata' => $data->getDataMultiple('biodata'),
            'transkrip' => $data->getDataMultiple('transkrip'),
            'bukti_bebas_lab' => $data->getDataMultiple('bukti-bebas-lab'),
            'artikel_jim' => $data->getDataMultiple('artikel-jim')
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}
    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);

    	if ($opsi == 'decline') {
    		Data::where(['user_id' => $user->first()->id, 'category' => 'data_yudisium'])->delete();
    		
    		$disposisi->update([
	            'progress' => 33
	        ]);
    		return redirect()->back()->with('error', 'Usulan telah ditolak');
    	} elseif ($opsi == 'accept') {
			Data::where(['user_id' => $user->first()->id, 'category' => 'data_yudisium'])->update([
				'verified' => true
			]);;

	        $disposisi->update([
	            'progress' => 36
	        ]);

	        return redirect()->back()->with('success', 'Usulan telah diterima');
	    }
	    return abort(404);
    }
}

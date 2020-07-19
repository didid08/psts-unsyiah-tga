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

class UsulanYudisiumController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-yudisium', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Yudisium',

            'semua_mahasiswa' => Disposisi::where('progress', 34)->orderBy('updated_at')->get(),
            'berkas_1' => $data->getDataMultiple('berkas-1'),
            'berkas_2' => $data->getDataMultiple('berkas-2'),
            'berkas_3' => $data->getDataMultiple('berkas-3'),
            'berkas_4' => $data->getDataMultiple('berkas-4')
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
		
	        $disposisi->update([
	            'progress' => 35
	        ]);

	        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
	    }
	    return abort(404);
    }
}

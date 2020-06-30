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

class UsulanPengesahanSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-pengesahan-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Pengesahan Sidang',

            'semua_mahasiswa' => Disposisi::where('progress', 29)->orderBy('updated_at')->get(),
            'berita_acara_sidang_buku' => $data->getDataMultiple('berita-acara-sidang-buku'),
            'buku_tga' => $data->getDataMultiple('buku-tga')
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
	                'progress' => 28
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':

	            $disposisi->update([
                    'progress' => 30
                ]);

                return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    		break;
    		default:
    			return abort(404);
    	}	
    }
}

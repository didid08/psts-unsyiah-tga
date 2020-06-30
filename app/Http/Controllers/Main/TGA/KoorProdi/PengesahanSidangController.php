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

class PengesahanSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.pengesahan-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Pengesahan Sidang',

            'semua_mahasiswa' => Disposisi::where('progress', 30)->orderBy('updated_at')->get(),
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
    			Data::where(['user_id' => $user->first()->id, 'name' => 'berita-acara-sidang-buku'])->update([
                    'verified' => true
                ]);
                Data::where(['user_id' => $user->first()->id, 'name' => 'buku-tga'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress' => 31
                ]);

                return redirect()->back()->with('success', 'Usulan telah diterima');
    		break;
    		default:
    			return abort(404);
    	}	
    }
}

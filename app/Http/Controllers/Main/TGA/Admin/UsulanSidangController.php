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

class UsulanSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Sidang',

            'semua_mahasiswa' => Disposisi::where('progress', 22)->orderBy('updated_at')->get(),
            'jumlah_asistensi_2' => $data->getDataMultiple('jumlah-asistensi-2'),
            'masa_pembimbingan_buku_tga' => $data->getDataMultiple('masa-pembimbingan-buku-tga'),
            'lembar_asistensi_2' => $data->getDataMultiple('lembar-asistensi-2'),
            'draft_buku_tga' => $data->getDataMultiple('draft-buku-tga'),
            'ijazah' => $data->getDataMultiple('ijazah'),
            'bukti_nilai_toefl' => $data->getDataMultiple('bukti-nilai-toefl')
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
	                'progress' => 21
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':

	            $disposisi->update([
                    'progress' => 23
                ]);

                return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor TGA');
    		break;
    		default:
    			return abort(404);
    	}
    	
    }
}

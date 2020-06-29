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

class PengesahanSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.pengesahan-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Pengesahan Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 17)->orderBy('updated_at')->get(),
            'berita_acara_seminar_proposal' => $data->getDataMultiple('berita-acara-seminar-proposal'),
            'buku_proposal' => $data->getDataMultiple('buku-proposal')
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
	                'progress' => 15
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':
    			Data::where(['user_id' => $user->first()->id, 'name' => 'berita-acara-seminar-proposal'])->update([
                    'verified' => true
                ]);
                Data::where(['user_id' => $user->first()->id, 'name' => 'buku-proposal'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress' => 18
                ]);

                return redirect()->back()->with('success', 'Usulan telah diterima');
    		break;
    		default:
    			return abort(404);
    	}	
    }
}

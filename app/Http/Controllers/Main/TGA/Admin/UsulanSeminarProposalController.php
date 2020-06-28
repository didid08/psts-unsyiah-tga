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

class UsulanSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 9)->orderBy('updated_at')->get(),
            'jumlah_asistensi' => $data->getDataMultiple('jumlah-asistensi'),
            'masa_pembimbingan_proposal' => $data->getDataMultiple('masa-pembimbingan-proposal'),
            'lembar_asistensi' => $data->getDataMultiple('lembar-asistensi'),
            'draft_buku_proposal' => $data->getDataMultiple('draft-buku-proposal')
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
	                'progress' => 8
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':

	            $disposisi->update([
                    'progress' => 10
                ]);

                return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor TGA');
    		break;
    		default:
    			return abort(404);
    	}
    	
    }
}

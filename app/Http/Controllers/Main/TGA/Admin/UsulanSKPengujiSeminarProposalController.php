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

class UsulanSKPengujiSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-sk-penguji-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan SK Penguji Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 11)->orderBy('updated_at')->get(),
            'jumlah_asistensi' => $data->getDataMultiple('jumlah-asistensi'),
            'masa_pembimbingan_proposal' => $data->getDataMultiple('masa-pembimbingan-proposal'),
            'lembar_asistensi' => $data->getDataMultiple('lembar-asistensi'),
            'draft_buku_proposal' => $data->getDataMultiple('draft-buku-proposal')
        ]);
    }

    public function process($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	
        $disposisi->update([
            'progress' => 12
        ]);

        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    }
}

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

class UsulanDaftarHadirSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-daftar-hadir-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan Kelengkapan Dokumen Administrasi Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 19)->orderBy('updated_at')->get(),
            'daftar_hadir_seminar_proposal' => $data->getDataMultiple('daftar-hadir-seminar-proposal')
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
	                'progress' => 18
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':
    			Data::where(['user_id' => $user->first()->id, 'name' => 'daftar-hadir-seminar-proposal'])->update([
                    'verified' => true
                ]);
	            $disposisi->update([
                    'progress' => 20
                ]);

                return redirect()->back()->with('success', 'Usulan telah diterima');
    		break;
    		default:
    			return abort(404);
    	}	
    }
}

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

class PenetapanSKPengujiSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.penetapan-sk-penguji-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Penetapan SK Penguji Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 12)->orderBy('updated_at')->get(),
            'jumlah_asistensi' => $data->getDataMultiple('jumlah-asistensi'),
            'masa_pembimbingan_proposal' => $data->getDataMultiple('masa-pembimbingan-proposal'),
            'lembar_asistensi' => $data->getDataMultiple('lembar-asistensi'),
            'draft_buku_proposal' => $data->getDataMultiple('draft-buku-proposal'),
            'sk_penguji_sempro' => $data->getDataMultiple('sk-penguji-sempro'),
            'undangan_sempro' => $data->getDataMultiple('undangan-sempro'),
            'berkas_seminar_lainnya' => $data->getDataMultiple('berkas-seminar-lainnya')
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	if ($opsi == 'decline')
    	{
    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	        $disposisi->update([
	            'progress' => 11
	        ]);
	        return redirect()->back()->with('error', 'Usulan telah ditolak');
    	}
    	elseif ($opsi == 'accept')
    	{
    		$jumlahYgAdaNomorSK = Data::where('name', 'sk-penguji-sempro')->whereNotNull('no')->whereNotNull('tgl')->get()->count();
            $noSK = $jumlahYgAdaNomorSK+1;

            if (Data::where(['user_id' => $user->first()->id, 'name' => 'sk-penguji-sempro'])->first()->no == null) {
                Data::where(['user_id' => $user->first()->id, 'name' => 'sk-penguji-sempro'])->update([
                    'no' => $noSK.'/TA/II/'.date('Y'),
                    'tgl' => date('Y m d')
                ]);
            }

            Data::where(['user_id' => $user->first()->id, 'name' => 'sk-penguji-sempro'])->update([
                'verified' => true
            ]);
            Data::where(['user_id' => $user->first()->id, 'name' => 'undangan-sempro'])->update([
                'verified' => true
            ]);
            Data::where(['user_id' => $user->first()->id, 'name' => 'berkas-seminar-lainnya'])->update([
                'verified' => true
            ]);

    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	        $disposisi->update([
	            'progress' => 13
	        ]);

	        return redirect()->back()->with('success', 'SK Penguji Seminar Proposal berhasil ditetapkan');
    	}

    	return abort(404);
    }
}

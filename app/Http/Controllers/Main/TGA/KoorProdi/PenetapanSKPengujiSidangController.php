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

class PenetapanSKPengujiSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.penetapan-sk-penguji-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Penetapan SK Penguji Sidang',

            'semua_mahasiswa' => Disposisi::where('progress', 25)->orderBy('updated_at')->get(),
            'jumlah_asistensi_2' => $data->getDataMultiple('jumlah-asistensi-2'),
            'masa_pembimbingan_buku_tga' => $data->getDataMultiple('masa-pembimbingan-buku-tga'),
            'lembar_asistensi_2' => $data->getDataMultiple('lembar-asistensi-2'),
            'draft_buku_tga' => $data->getDataMultiple('draft-buku-tga'),
            'sk_penguji_sidang' => $data->getDataMultiple('sk-penguji-sidang'),
            'undangan_sidang' => $data->getDataMultiple('undangan-sidang'),
            'berkas_sidang_lainnya' => $data->getDataMultiple('berkas-sidang-lainnya')
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
	            'progress' => 24
	        ]);
	        return redirect()->back()->with('error', 'Usulan telah ditolak');
    	}
    	elseif ($opsi == 'accept')
    	{
    		$jumlahYgAdaNomorSK = Data::where('name', 'sk-penguji-sidang')->whereNotNull('no')->whereNotNull('tgl')->get()->count();
            $noSK = $jumlahYgAdaNomorSK+1;

            if (Data::where(['user_id' => $user->first()->id, 'name' => 'sk-penguji-sidang'])->first()->no == null) {
                Data::where(['user_id' => $user->first()->id, 'name' => 'sk-penguji-sidang'])->update([
                    'no' => $noSK.'/TA/II/'.date('Y'),
                    'tgl' => date('Y m d')
                ]);
            }

            Data::where(['user_id' => $user->first()->id, 'name' => 'sk-penguji-sidang'])->update([
                'verified' => true
            ]);
            Data::where(['user_id' => $user->first()->id, 'name' => 'undangan-sidang'])->update([
                'verified' => true
            ]);
            Data::where(['user_id' => $user->first()->id, 'name' => 'berkas-sidang-lainnya'])->update([
                'verified' => true
            ]);

    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	        $disposisi->update([
	            'progress' => 26
	        ]);

	        return redirect()->back()->with('success', 'SK Penguji Seminar Proposal berhasil ditetapkan');
    	}

    	return abort(404);
    }
}

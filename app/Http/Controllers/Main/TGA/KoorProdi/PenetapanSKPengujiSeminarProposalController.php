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
use Illuminate\Support\Facades\Mail;
use App\Mail\BeritahuKomisiPenguji;
use Zip;

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

            // Construct berkas zip
            $filetoadd = ['sk-penguji-sempro', 'undangan-sempro', 'berkas-seminar-lainnya'];
            $zip = Zip::create(storage_path().'/app/data/'.$nim.'-berkas-seminar-proposal.zip');
            foreach ($filetoadd as $index => $value) {
                $zip->add(storage_path().'/app/data/'.$nim.'-'.$value.'.pdf');
            }
            $zip->close();

            //Email ke komisi penguji
            $komisi_penguji = [
                Data::where(['user_id' => $user->first()->id, 'name' => 'ketua-penguji'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'penguji-1'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'penguji-2'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'penguji-3'])->first()->content
            ];

            $email_komisi_penguji = [
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[0]])->first()->email,
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[1]])->first()->email,
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[2]])->first()->email,
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[3]])->first()->email
            ];

            $jadwal_seminar = [
                Data::where(['user_id' => $user->first()->id, 'name' => 'tgl-seminar'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'jam-seminar'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'tempat-seminar'])->first()->content
            ];

            Mail::to($email_komisi_penguji[0])->send(new BeritahuKomisiPenguji('ketua penguji', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));
            Mail::to($email_komisi_penguji[1])->send(new BeritahuKomisiPenguji('penguji 1', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));
            Mail::to($email_komisi_penguji[2])->send(new BeritahuKomisiPenguji('penguji 2', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));
            Mail::to($email_komisi_penguji[3])->send(new BeritahuKomisiPenguji('penguji 3', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));

            //Update disposisi
    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	        $disposisi->update([
	            'progress' => 13
	        ]);

	        return redirect()->back()->with('success', 'SK Penguji Seminar Proposal berhasil ditetapkan');
    	}

    	return abort(404);
    }
}

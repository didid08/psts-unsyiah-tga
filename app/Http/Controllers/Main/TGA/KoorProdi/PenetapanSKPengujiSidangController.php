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
use App\Mail\BeritahuKomisiPenguji2;
use Zip;

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

            // Construct berkas zip
            $filetoadd = ['sk-penguji-sidang', 'undangan-sidang', 'berkas-sidang-lainnya'];
            $zip = Zip::create(storage_path().'/app/data/'.$nim.'-berkas-sidang-buku-tga.zip');
            foreach ($filetoadd as $index => $value) {
                $zip->add(storage_path().'/app/data/'.$nim.'-'.$value.'.pdf');
            }
            $zip->close();

            //Email ke komisi penguji
            $komisi_penguji = [
                Data::where(['user_id' => $user->first()->id, 'name' => 'ketua-penguji-2'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'penguji-1-2'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'penguji-2-2'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'penguji-3-2'])->first()->content
            ];

            $email_komisi_penguji = [
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[0]])->first()->email,
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[1]])->first()->email,
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[2]])->first()->email,
                User::where(['category' => 'dosen', 'nama' => $komisi_penguji[3]])->first()->email
            ];

            $jadwal_seminar = [
                Data::where(['user_id' => $user->first()->id, 'name' => 'tgl-sidang'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'jam-sidang'])->first()->content,
                Data::where(['user_id' => $user->first()->id, 'name' => 'tempat-sidang'])->first()->content
            ];

            Mail::to($email_komisi_penguji[0])->send(new BeritahuKomisiPenguji2('ketua penguji', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));
            Mail::to($email_komisi_penguji[1])->send(new BeritahuKomisiPenguji2('penguji 1', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));
            Mail::to($email_komisi_penguji[2])->send(new BeritahuKomisiPenguji2('penguji 2', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));
            Mail::to($email_komisi_penguji[3])->send(new BeritahuKomisiPenguji2('penguji 3', $user->first()->nama, $nim, $jadwal_seminar[0], $jadwal_seminar[1], $jadwal_seminar[2]));

            //Update disposisi
    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	        $disposisi->update([
	            'progress' => 26
	        ]);

	        return redirect()->back()->with('success', 'SK Penguji Sidang berhasil ditetapkan');
    	}

    	return abort(404);
    }
}

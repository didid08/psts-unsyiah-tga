<?php

namespace App\Http\Controllers\Main\TGA\KoorProdi;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\User;
use App\Disposisi;
use App\Data;

class PenetapanSKPembimbingController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.penetapan-sk-pembimbing', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Penetapan SK Pembimbing',

            'semua_mahasiswa' => Disposisi::where('progress', 6)->orderBy('updated_at')->get(),
            'pembimbing' => $data->getDataMultiple('pembimbing'),
            'co_pembimbing' => $data->getDataMultiple('co-pembimbing'),
            'sk_pembimbing' => $data->getDataMultiple('sk-pembimbing')
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
                    'progress' => 5
                ]);
                return redirect()->back()->with('error', 'Usulan telah ditolak');
            break;

            case 'accept':

                $jumlahYgAdaNomorSK = Data::where('name', 'sk-pembimbing')->whereNotNull('no')->whereNotNull('tgl')->get()->count();
                $noSK = $jumlahYgAdaNomorSK+1;

                if (Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing'])->first()->no == null) {
                    Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing'])->update([
                        'no' => $noSK.'/TA/II/'.date('Y'),
                        'tgl' => date('Y m d')
                    ]);
                }

                Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing'])->update([
                    'verified' => true
                ]);

                $disposisi->update([
                    'progress' => 7,
                    'progress_optional' => 1
                ]);

                return redirect()->back()->with('success', 'SK Pembimbing telah ditetapkan');
            break;
            default:
                return abort(404);
        }
    }
}

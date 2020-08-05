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
            case 'accept':

                Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing'])->update([
                    'tgl' => date('Y m d'),
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

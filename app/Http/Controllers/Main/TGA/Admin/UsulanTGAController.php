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
use App\Setting;

class UsulanTGAController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan TGA',

            'semua_mahasiswa' => Disposisi::where('progress', 2)->orderBy('updated_at')->get(),
            'spp' => $data->getDataMultiple('spp'),
            'krs' => $data->getDataMultiple('krs'),
            'khs' => $data->getDataMultiple('khs'),
            'transkrip_sementara' => $data->getDataMultiple('transkrip-sementara'),
            'foto' => $data->getDataMultiple('foto')
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
                    'progress' => 1
                ]);
                return redirect()->back()->with('error', 'Usulan telah ditolak');
            break;

            case 'accept':
                $disposisi->update([
                    'progress' => 3
                ]);

                return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
            break;
            default:
                return abort(404);
        }
    }
}

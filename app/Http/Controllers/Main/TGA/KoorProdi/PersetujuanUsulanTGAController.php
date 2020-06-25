<?php

namespace App\Http\Controllers\Main\TGA\KoorProdi;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\Data;
use App\Disposisi;

class PersetujuanUsulanTGAController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.koor-prodi.persetujuan-usulan-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Persetujuan Usulan TGA',

            'semua_mahasiswa' => Disposisi::where('progress', 3)->orderBy('updated_at')->get(),
            'spp' => $data->getDataMultiple('spp'),
            'krs' => $data->getDataMultiple('krs'),
            'khs' => $data->getDataMultiple('khs'),
            'transkrip_sementara' => $data->getDataMultiple('transkrip-sementara'),
            'foto' => $data->getDataMultiple('foto')
        ]);
    }
}

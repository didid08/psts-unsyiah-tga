<?php

namespace App\Http\Controllers\Main\TGA\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\Data;
use App\Disposisi;

class UsulanTGAController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan TGA',

            'semua_mahasiswa' => Disposisi::where('progress', 2)->get(),
            'spp' => $data->getDataMultiple('spp'),
            'krs' => $data->getDataMultiple('krs'),
            'khs' => $data->getDataMultiple('khs'),
            'transkrip_sementara' => $data->getDataMultiple('transkrip-sementara')
        ]);
    }
}

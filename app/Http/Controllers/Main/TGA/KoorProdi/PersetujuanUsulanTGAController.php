<?php

namespace App\Http\Controllers\Main\TGA\KoorProdi;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;

class PersetujuanUsulanTGAController extends MainController
{
    public function view()
    {
    	return $this->customView('tga.koor-prodi.persetujuan-usulan-tga', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Persetujuan Usulan TGA',
        ]);
    }
}

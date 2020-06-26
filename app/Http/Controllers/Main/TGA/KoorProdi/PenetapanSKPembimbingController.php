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
}

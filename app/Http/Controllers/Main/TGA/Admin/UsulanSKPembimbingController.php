<?php

namespace App\Http\Controllers\Main\TGA\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\User;
use App\Disposisi;
use App\Data;

class UsulanSKPembimbingController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-sk-pembimbing', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan SK Pembimbing',

            'semua_mahasiswa' => Disposisi::where('progress', 5)->orderBy('updated_at')->get(),
            'pembimbing' => $data->getDataMultiple('pembimbing'),
            'co_pembimbing' => $data->getDataMultiple('co-pembimbing')
        ]);
    }
}

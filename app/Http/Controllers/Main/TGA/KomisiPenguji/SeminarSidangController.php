<?php

namespace App\Http\Controllers\Main\TGA\KomisiPenguji;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Data;
use App\Disposisi;
use App\User;

class SeminarSidangController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.komisi-penguji.seminar-sidang', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Daftar Seminar/Sidang',

            'semua_mahasiswa_1' => Data::where(['name' => 'ketua-penguji', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 13)
            						->orderBy('updated_at')
            						->get(),
            'semua_mahasiswa_2' => Data::where(['name' => 'ketua-penguji-2', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 26)
            						->orderBy('updated_at')
            						->get(),
            'daftar_ketua_penguji' => $data->getDataMultiple('ketua-penguji'),
            'daftar_penguji_1' => $data->getDataMultiple('penguji-1'),
            'daftar_penguji_2' => $data->getDataMultiple('penguji-2'),
            'daftar_penguji_3' => $data->getDataMultiple('penguji-3'),
            'jam_seminar' => $data->getDataMultiple('jam-seminar'),
            'tgl_seminar' => $data->getDataMultiple('tgl-seminar'),
            'tempat_seminar' => $data->getDataMultiple('tempat-seminar'),

            'daftar_ketua_penguji_2' => $data->getDataMultiple('ketua-penguji-2'),
            'daftar_penguji_1_2' => $data->getDataMultiple('penguji-1-2'),
            'daftar_penguji_2_2' => $data->getDataMultiple('penguji-2-2'),
            'daftar_penguji_3_2' => $data->getDataMultiple('penguji-3-2'),
            'jam_sidang' => $data->getDataMultiple('jam-sidang'),
            'tgl_sidang' => $data->getDataMultiple('tgl-sidang'),
            'tempat_sidang' => $data->getDataMultiple('tempat-sidang')
        ]);
    }

    public function markDone($nim, $type, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
    	
    	if ($type == 'seminar')
    	{
    		$disposisi->update([
				'progress' => 14
			]);
            return redirect()->back()->with('success', 'Seminar telah dijadikan selesai');
    	}
         elseif ($type == 'sidang')
        {
            $disposisi->update([
                'progress' => 27
            ]);
            return redirect()->back()->with('success', 'Sidang telah dijadikan selesai');
        }
    }
}

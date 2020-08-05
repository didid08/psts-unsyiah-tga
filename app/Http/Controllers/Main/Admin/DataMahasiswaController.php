<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\User;
use App\Data;
use App\Disposisi;

class DataMahasiswaController extends MainController
{
    public function __invoke ($nim = null)
    {
    	if ($nim != null)
    	{
    		$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
	    	if (!$user->exists()) {
	    		return abort(404);
	    	}

	    	return $this->customView('admin.data-mahasiswa', [
	            'nav_item_active' => 'data-mahasiswa',
                'nim' => $nim,
	            'subtitle' => 'Data: '.$user->first()->nama.' ('.$user->first()->nomor_induk.')',
	            'semua_data' => Data::where(['user_id' => $user->first()->id, 'verified' => true])->orderBy('category')->get(),
	            'get_data' => true
	        ]);
    	}
    	return $this->customView('admin.data-mahasiswa', [
            'nav_item_active' => 'data-mahasiswa',
            'subtitle' => 'Data Mahasiswa',
            'semua_mahasiswa' => User::dataWithCategory('mahasiswa'),
        ]);
    }
}

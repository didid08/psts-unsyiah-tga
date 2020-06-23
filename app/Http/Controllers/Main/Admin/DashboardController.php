<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;

class DashboardController extends MainController
{
    public function dashboard()
    {
    	return $this->customView('admin.dashboard', [
            'nav_item_active' => 'dashboard',
            'subtitle' => 'Dashboard',
            'semua_mahasiswa' => User::dataWithCategory('mahasiswa')
        ]);
    }

    public function dashboardWithData(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'nim' => 'required|not_in:empty'
        ], [
        	'required' => 'NIM tidak boleh kosong',
        	'not_in' => 'Harap pilih NIM terlebih dahulu'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (User::where('nomor_induk', $request->input('nim'))->exists()) {
            return $this->customView('admin.dashboard', [
                'nav_item_active' => 'dashboard',
                'subtitle' => 'Dashboard',
                'semua_mahasiswa' => User::dataWithCategory('mahasiswa'),
                'mhs' => User::firstWhere('nomor_induk', $request->input('nim'))
            ]);
        }
        return redirect(route('main.dashboard', ['category' => 'admin']))->with('error', 'Data tidak ditemukan');
    }
}

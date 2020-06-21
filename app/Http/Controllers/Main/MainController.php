<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Main\Admin\AdminController;
use App\User;
use App\Setting;

class MainController extends Controller
{
    public function customView($viewName, $data = [])
    {

        $nama = 'Tamu';
        if (session('auth')['category'] != 'tamu') {
            $nama = User::data('nama');
        }

        $identity;

        if (in_array(session('auth')['category'], array('dosen', 'mahasiswa'))) {
            $identity = User::data('nomor_induk');
        }else if (session('auth')['category'] == 'admin') {
            $identity = "Admin";
        }else {
            $identity = '--';
        }

    	return view('main.'.$viewName, array_merge([
    		'title' => Setting::get('site_title'),
            'category' => session('auth')['category'],
            'nama' => $nama,
            'identity' => $identity
    	], $data));

    }

    public function dashboard()
    {
    	if (session('auth')['category'] == 'admin') {
            $admin_controller = new AdminController();
    		return $admin_controller->dashboard();
    	}else {

            $nav_item_active = 'dashboard';
            $subtitle = 'Dashboard';

            if (session('auth')['category'] == 'tamu') {
                $nav_item_active = 'informasi-tga';
                $subtitle = 'Informasi TGA';
            }

    		return $this->customView('dashboard', [
                'nav_item_active' => $nav_item_active,
                'subtitle' => $subtitle
            ]);
    	}
    }

    public function infoDosen()
    {
        $user = new User();

        return $this->customView('info-dosen', [
            'nav_item_active' => 'dosen',
            'subtitle' => 'Info Dosen',
            'semua_dosen' => User::dataWithCategory('dosen'),
            'data' => [
                'bimbingan' => [
                    'total' => $user->calculateBimbingan('total'),
                    'selesai' => $user->calculateBimbingan('selesai')
                ],
                'co_bimbingan' => [
                    'total' => $user->calculateCoBimbingan('total'),
                    'selesai' => $user->calculateCoBimbingan('selesai')
                ]
            ]
        ]);
    }

    public function rekapDosen()
    {
        return $this->customView('rekap-dosen', [
            'nav_item_active' => 'dosen',
            'subtitle' => 'Rekap Dosen',
            'semua_dosen' => User::dataWithCategory('dosen')
        ]);
    }
}

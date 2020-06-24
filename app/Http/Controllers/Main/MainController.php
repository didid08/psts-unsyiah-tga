<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Main\Admin\DashboardController;
use App\User;
use App\UserRole;
use App\Setting;

class MainController extends Controller
{
    public function customView($viewName, $data = [])
    {

        $nama = 'Tamu';
        if (session('auth')['category'] != 'tamu') {
            $nama = User::myData('nama');
        }

        $identity;

        if (in_array(session('auth')['category'], array('dosen', 'mahasiswa'))) {
            $identity = User::myData('nomor_induk');
        }else if (session('auth')['category'] == 'admin') {
            $identity = "Admin";
        }else {
            $identity = '--';
        }

        $userRole = new UserRole();

    	return view('main.'.$viewName, array_merge([
    		'title' => Setting::get('site_title'),
            'category' => session('auth')['category'],
            'nama' => $nama,
            'identity' => $identity,
            'role' => $userRole->myRoles()
    	], $data));

    }

    public function dashboard()
    {
        $userRole = new UserRole();
        $role = $userRole->myRoles();
    	if (isset($role->admin)) {
            $admin_dashboard_controller = new DashboardController;
    		return $admin_dashboard_controller->dashboard();
    	}else {

            $nav_item_active = 'dashboard';
            $subtitle = 'Dashboard';

    		return $this->customView('dashboard', [
                'nav_item_active' => $nav_item_active,
                'subtitle' => $subtitle
            ]);
    	}
    }

    public function infoDosen()
    {
        $user = new User();

        return $this->customView('dosen.info', [
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
        return $this->customView('dosen.rekap', [
            'nav_item_active' => 'dosen',
            'subtitle' => 'Rekap Dosen',
            'semua_dosen' => User::dataWithCategory('dosen')
        ]);
    }
}

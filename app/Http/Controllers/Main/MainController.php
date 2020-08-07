<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Main\Admin\DashboardController;
use App\User;
use App\UserRole;
use App\Data;
use App\Disposisi;
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

        if (session('auth')['category'] == 'tamu') {
            return view('main.'.$viewName, array_merge([
                'title' => Setting::get('site_title'),
                'category' => session('auth')['category'],
                'nama' => $nama,
                'identity' => $identity
            ], $data));
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
        $userRole = new UserRole;
        $data = new Data;

        if (session('auth')['category'] == 'tamu') {
            return $this->customView('dashboard', [
                'nav_item_active' => 'dashboard',
                'subtitle' => 'Dashboard',
            ]);
        } else {
    		return $this->customView('dashboard', [
                'nav_item_active' => 'dashboard',
                'subtitle' => 'Dashboard',
                'role' => $userRole->myRoles(),
                'saya' => User::myAllData(),

                'mahasiswa_bimbingan' => Data::where(['name' => 'pembimbing', 'content' => User::myData('nama'), 'verified' => true])
                                            ->orderBy('updated_at')
                                            ->join('users', 'data.user_id', '=', 'users.id')
                                            ->select('users.*')
                                            ->get(),

                'mahasiswa_co_bimbingan' => Data::where(['name' => 'co-pembimbing', 'content' => User::myData('nama'), 'verified' => true])
                                            ->orderBy('updated_at')
                                            ->join('users', 'data.user_id', '=', 'users.id')
                                            ->select('users.*')
                                            ->get(),                                        

                'semua_mahasiswa' => Disposisi::where('progress', '>', 1)->where('progress', '<', 36)->orderBy('updated_at')->get(),
                'semua_mahasiswa_opsional' => Disposisi::where('progress_optional', '>', 1)->where('progress_optional', '<', 6)->where('progress', '<', 26)->orderBy('updated_at')->get()
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

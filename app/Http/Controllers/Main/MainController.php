<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Main\Admin\AdminController;

use App\User;
use App\UserRole;
use App\AdministrasiTGA;
use App\DataTGA;
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

    public function administrasiTGA($category, $nim = null)
    {
        if ($category == 'mahasiswa') {
            if ($nim == null) {

                $data_tga = new DataTGA();
                $mahasiswa_data_tga = $data_tga->listData(User::data('id'));
                $administrasi_tga = User::find(User::data('id'))->administrasiTGA();

                $user_roles = new UserRole();
                $my_roles = $user_roles->myRoles();

                if ($administrasi_tga->exists()) { 
                    return $this->customView('administrasi-tga.main', [
                        'nav_item_active' => 'tga',
                        'subtitle' => 'Administrasi TGA',

                        'roles' => $my_roles,

                        'administrasi_tga' => $administrasi_tga,

                        'mahasiswa' => User::where('nomor_induk', User::data('nomor_induk'))->first(),
                        'mahasiswa_data_tga' => $mahasiswa_data_tga
                    ]);
                }

                return redirect(route('main.mahasiswa.input-data-tga'))->with('warning', 'Anda harus mengisi Data Usul TGA terlebih dahulu');
            }
            return abort(404);

        } else {

            $extra_data = [];

            // Cek Mahasiswa
            if ($nim != null) {

                $mahasiswa = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);

                // Apakah Mahasiswa dengan NIM tsb tidak ada?
                if (!$mahasiswa->exists()) {
                    return abort(404);
                }

                //Jika ada, apakah mahasiswa tsb belum mengisi Data Usul TGA?
                $administrasi_tga = User::find($mahasiswa->first()->id)->administrasiTGA();
                if (!$administrasi_tga->exists()) {
                    return abort(404);
                }

                $user_role = new UserRole ();
                $my_roles = $user_role->myRoles();

                $adm = new AdministrasiTGA ();
                if (!$adm->isEligibleToView($nim, User::data('nama'))) {
                    return response('Anda tidak mempunyai perizinan untuk melihat progress mahasiswa yang anda pilih.');   
                }

                $data_tga = new DataTGA ();

                $user = new User;
                $daftar_bimbingan = $user->calculateBimbingan('total');
                $daftar_co_bimbingan = $user->calculateCoBimbingan('total');
                $semua_dosen_bimbingan = [];
                $semua_dosen_co_bimbingan = [];
                foreach (User::dataWithCategory('dosen') as $x) {
                    if ($daftar_bimbingan[$x->nama] < 10) {
                        array_push($semua_dosen_bimbingan, $x);
                    }
                }
                foreach (User::dataWithCategory('dosen') as $x) {
                    if ($daftar_co_bimbingan[$x->nama] < 10) {
                        array_push($semua_dosen_co_bimbingan, $x);
                    }
                }

                $extra_data = [
                    'mahasiswa' => User::firstWhere('nomor_induk', $nim),
                    'mahasiswa_data_tga' => $data_tga->listData(User::firstWhere('nomor_induk', $nim)->id),
                    'roles' => $my_roles,
                    'administrasi_tga' => $administrasi_tga,
                    'semua_dosen_bimbingan' => json_decode(json_encode($semua_dosen_bimbingan)),
                    'semua_dosen_co_bimbingan' => json_decode(json_encode($semua_dosen_co_bimbingan)),
                    'isPembimbing' => $adm->isPembimbing($nim, User::data('nama'))
                ];

            } else {
                $adm = new AdministrasiTGA;
                $list = $adm->list();

                $extra_data['administrasi_tga'] = $list;
            }

            return $this->customView('administrasi-tga.main', array_merge([
                'nav_item_active' => 'tga',
                'subtitle' => 'Administrasi TGA',
                'nim' => $nim
            ], $extra_data));
        }
    }
}

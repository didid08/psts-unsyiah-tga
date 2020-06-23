<?php

namespace App\Http\Controllers\Main\AdministrasiTGA;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\AdministrasiTGA;
use App\DataTGA;
use App\Setting;
use App\Task;

class ViewController extends MainController
{
    public function __invoke($category, $nim = null)
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

                $mhs_id = User::firstWhere('nomor_induk', $nim)->id;

                $user_role = new UserRole ();
                $my_roles = $user_role->myRoles();

                $adm = new AdministrasiTGA ();
                if (!$adm->isEligibleToView($mhs_id, User::data('nama'))) {
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
                    'mahasiswa_data_tga' => $data_tga->listData($mhs_id),
                    'roles' => $my_roles,
                    'administrasi_tga' => $administrasi_tga,


                    'semua_dosen' => User::dataWithCategory('dosen'),
                    'semua_dosen_bimbingan' => json_decode(json_encode($semua_dosen_bimbingan)),
                    'semua_dosen_co_bimbingan' => json_decode(json_encode($semua_dosen_co_bimbingan)),

                    'is_pembimbing' => $adm->isPembimbing($mhs_id, User::data('nama')),

                    'pembimbing_isset' => $data_tga->checkSingleData($mhs_id, 'nama-pembimbing'),
                    'co_pembimbing_isset' => $data_tga->checkSingleData($mhs_id, 'nama-co-pembimbing'),

                    'pembimbing_accepted' => $adm->isAccepted($mhs_id, 'nama-pembimbing'),
                    'co_pembimbing_accepted' => $adm->isAccepted($mhs_id, 'nama-co-pembimbing'),

                    /*'ketua_penguji_accepted' => $adm->isAccepted($mhs_id, 'ketua-penguji'),
                    'penguji_1_accepted' => $adm->isAccepted($mhs_id, 'penguji-1'),
                    'penguji_2_accepted' => $adm->isAccepted($mhs_id, 'penguji-2'),
                    'penguji_3_accepted' => $adm->isAccepted($mhs_id, 'penguji-3'),*/
                    'is_ketua_penguji' => $adm->isKetuaPenguji($mhs_id, User::data('nama')),

                    'task_set_pembimbing' => Task::where(['user_id' => $mhs_id, 'task_name' => 'set.pembimbing']),
                    'task_set_co_pembimbing' => Task::where(['user_id' => $mhs_id, 'task_name' => 'set.co_pembimbing'])
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
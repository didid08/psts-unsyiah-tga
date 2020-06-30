<?php

namespace App\Http\Controllers\Main\TGA;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class DisposisiController extends MainController
{
    public function view($nim = null)
    {
        $userRole = new UserRole();
        $role = $userRole->myRoles();

        if (isset($role->mhs)) {
            if ($nim == null) {

                $id = User::myData('id');
                $data = new Data();
                
                return $this->customView('tga.disposisi.main', [
                    'nav_item_active' => 'tga',
                    'subtitle' => 'Disposisi',
                    'role' => $role,
                    'mahasiswa' => User::where('id', $id)->first(),
                    'disposisi' => Disposisi::where('user_id', $id)->first(),
                    'data' => $data->listData($id),
                    'cek_berkas_yudisium' => $data->checkMultipleData($id, ['biodata', 'transkrip', 'bukti-bebas-lab', 'artikel-jim'])
                ]);
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

                $mhs_id = User::firstWhere('nomor_induk', $nim)->id;
                /*$disposisi = new Disposisi;
                if (!$disposisi->isEligibleToView($mhs_id, User::myData('id'))) {
                    return redirect()->back()->with('error', 'Anda tidak memiliki perizinan untuk melihat disposisi mahasiswa yang anda pilih');
                }*/

                $user_role = new UserRole ();
                $my_roles = $user_role->myRoles();

                $data = new Data ();
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
                    'mahasiswa_data_tga' => $data->listData($mhs_id),
                    'roles' => $my_roles,
                    'disposisi' => Disposisi::where('user_id', $mhs_id)->first(),
                    'data' => $data->listData($mhs_id),
                    'semua_dosen' => User::dataWithCategory('dosen'),
                    'semua_dosen_bimbingan' => json_decode(json_encode($semua_dosen_bimbingan)),
                    'semua_dosen_co_bimbingan' => json_decode(json_encode($semua_dosen_co_bimbingan))
                ];

            } else {
                $extra_data['disposisi'] = Disposisi::orderBy('user_id')->get();
            }

            return $this->customView('tga.disposisi.main', array_merge([
                'nav_item_active' => 'tga',
                'subtitle' => 'Disposisi',
                'nim' => $nim
            ], $extra_data));
        }
    }

    public function terimaUsul($name, $nim, Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'key' => 'required'
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $mhs = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if ($mhs->exists()) {

            $data = Data::where(['user_id' => $mhs->first()->id, 'name' => $name]);
            if ($data->exists()) {

                if ($data->first()->verified == true) {
                    return abort(404);
                }

                $requestHari = 7;
                if (in_array($name, ['pembimbing', 'co-pembimbing'])) {
                    $requestHari = 2;
                }

                $diff = time() - strtotime($data->first()->updated_at);
                $hariLewat = floor($diff / (60 * 60 * 24));
                if ($hariLewat >= $requestHari) {
                    return abort(404);
                }

                if (Hash::check($request->input('key'), $data->first()->verification_key))
                {
                    $data->update([
                        'verified' => true,
                        'verification_key' => null
                    ]);
                    $name2 = $name;
                    if ($name = 'ketua-penguji-2') {
                        $name2 = 'ketua-penguji';
                    }elseif ($name = 'penguji-1-2') {
                        $name2 = 'penguji-1';
                    }elseif ($name = 'penguji-2-2') {
                        $name2 = 'penguji-2';
                    }elseif ($name = 'penguji-3-2') {
                        $name2 = 'penguji-3';
                    }

                    return response('Anda telah setuju untuk dijadikan '.ucwords(str_replace('-', ' ', $name2)).' untuk mahasiswa bernama '.$mhs->first()->nama.' ('.$mhs->first()->nomor_induk.')');
                }
                return abort(404);
            }
            return abort(404);
        }
        return abort(404);
    }
}

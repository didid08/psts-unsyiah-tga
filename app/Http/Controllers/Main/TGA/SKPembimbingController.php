<?php

namespace App\Http\Controllers\Main\TGA;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;
use PDF;

class SKPembimbingController extends MainController
{
    public function __invoke($nim)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $userRole = new UserRole();
        $role = $userRole->myRoles();

        if (isset($role->mhs)) {
            if ($user->first()->nomor_induk != User::myData('nomor_induk')) {
                return abort(404);
            }
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress < 6) {
            return abort(404);
        }

        if (!isset($role->koor_prodi) && $disposisi->first()->progress < 7) {
            return abort(404);
        }

        $pdf = PDF::loadView('main.tga.sk-pembimbing', [
            'mahasiswa' => $user->first(),
            'pembimbing' => [
                'nama' => $user->first()->data->where('name', 'pembimbing')->first()->content,
                'nip' => User::where(['category' => 'dosen', 'nama' => $user->first()->data->where('name', 'pembimbing')->first()->content])->first()->nomor_induk
            ],
            'co_pembimbing' => [
                'nama' => $user->first()->data->where('name', 'co-pembimbing')->first()->content,
                'nip' => User::where(['category' => 'dosen', 'nama' => $user->first()->data->where('name', 'co-pembimbing')->first()->content])->first()->nomor_induk
            ],
            'sk_pembimbing' => [
            	'no' => $user->first()->data->where('name', 'sk-pembimbing')->first()->no,
            	'tgl' => $user->first()->data->where('name', 'sk-pembimbing')->first()->tgl
            ],
            'disposisi' => $user->first()->disposisi
        ])->setPaper('a4');
        return $pdf->stream($nim.'-sk-pembimbing.pdf');
    }
}

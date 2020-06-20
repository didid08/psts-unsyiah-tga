<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DataTGA;

class User extends Model
{
    protected $fillable = [
        'category', 'username', 'nomor_induk', 'nama', 'bidang_id', 'avatar', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function bidang() {
        return $this->belongsTo('App\Bidang');
    }

    public function userRole() {
    	return $this->hasMany('App\UserRole');
    }

    public function administrasiTGA() {
        return $this->hasOne('App\AdministrasiTGA');
    }

    public function dataTGA() {
        return $this->hasMany('App\DataTGA');
    }

    public function task() {
        return $this->hasMany('App\Task');
    }

    public static function data($column) {
        $auth = session('auth');

        $identityType;

        if (in_array($auth['category'], array('dosen', 'mahasiswa'))) {
            $identityType = 'nomor_induk';
        }else {
            $identityType = 'username';
        }

        return User::firstwhere($identityType, $auth['identity'][$identityType])->$column;
    }

    public static function dataWithCategory($category, $option = null) {
        if ($option != null) {
            if ($option == 'bidang') {
                return User::where('category', $category)->whereNotNull('bidang_id')->get();
            }
        }else {
            return User::where('category', $category)->get();
        }
    }

    public function dataBimbingan() {

        $bimbingan = [];

        $semua_dosen = $this->where('category', 'dosen')->get();

        foreach ($semua_dosen as $dosen) {
            $bimbingan[$dosen->nama] = [];
        }

        if (DataTGA::where('name', 'nama-pembimbing')->exists()) {

            $x = DataTGA::where('name', 'nama-pembimbing')->get();
            foreach ($x as $y) {
                array_push($bimbingan[$y->content], $y->user->nama);
            }
        }

        return $bimbingan;
    }

    public function calculateBimbingan($to_calculate) {

        $bimbingan = $this->dataBimbingan();

        if ($to_calculate == 'total') {

            $total_bimbingan = [];

            foreach ($bimbingan as $index => $value) {
                $total_bimbingan[$index] = count($value);
            }
            return $total_bimbingan;

        }
        else if ($to_calculate == 'selesai') {

            $selesai_bimbingan = [];

            foreach ($bimbingan as $index => $value) {
                $selesai_bimbingan[$index] = 0;

                if (count($value) != 0) {
                    foreach ($value as $value2) {
                        $mhs_id = $this->firstWhere('nama', $value2)->id;

                        if ($this->find($mhs_id)->administrasiTGA()->value('selesai') == true) {
                            $selesai_bimbingan[$index] = $selesai_bimbingan[$index]+1;
                        }
                    }
                }
            }
            return $selesai_bimbingan;

        }
        return false;
    }

    public function dataCoBimbingan() {

        $co_bimbingan = [];

        $semua_dosen = $this->where('category', 'dosen')->get();

        foreach ($semua_dosen as $dosen) {
            $co_bimbingan[$dosen->nama] = [];
        }

        if (DataTGA::where('name', 'nama-co-pembimbing')->exists()) {

            $x = DataTGA::where('name', 'nama-co-pembimbing')->get();
            foreach ($x as $y) {
                array_push($co_bimbingan[$y->content], $y->user->nama);
            }
        }

        return $co_bimbingan;
    }

    public function calculateCoBimbingan($to_calculate) {

        $bimbingan = $this->dataCoBimbingan();
        if ($to_calculate == 'total') {

            $total_bimbingan = [];
            foreach ($bimbingan as $index => $value) {
                $total_bimbingan[$index] = count($value);
            }
            return $total_bimbingan;

        }
        else if ($to_calculate == 'selesai') {

            $selesai_bimbingan = [];

            foreach ($bimbingan as $index => $value) {
                $selesai_bimbingan[$index] = 0;

                if (count($value) != 0) {
                    foreach ($value as $value2) {
                        $mhs_id = $this->firstWhere('nama', $value2)->id;

                        if ($this->find($mhs_id)->administrasiTGA()->value('selesai') == true) {
                            $selesai_bimbingan[$index] = $selesai_bimbingan[$index]+1;
                        }
                    }
                }
            }
            return $selesai_bimbingan;

        }
        return false;
    }
}

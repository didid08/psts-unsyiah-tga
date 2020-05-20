<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public static function dataWithCategory($category) {
        return User::where('category', $category)->get();
    }
}

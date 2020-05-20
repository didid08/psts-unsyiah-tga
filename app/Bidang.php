<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'bidang';

    protected $fillable = [
    	'nama'
    ];

    public function users() {
    	return $this->hasOne('App\User');
    }
}

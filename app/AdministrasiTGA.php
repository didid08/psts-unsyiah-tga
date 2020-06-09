<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrasiTGA extends Model
{
    protected $table = 'administrasi_tga';

    protected $fillable = [
    	'progress', 'repeat', 'progress_optional', 'repeat_optional'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

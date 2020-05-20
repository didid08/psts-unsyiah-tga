<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function userRole() {
    	return $this->hasMany('App\UserRole');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserRole extends Model
{
    protected $fillable = [
    	'user_id', 'role_id'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function role() {
    	return $this->belongsTo('App\Role');
    }

    public function myRoles() {
    	$get_roles = $this->where('user_id', User::myData('id'))->get();
        $roles = [];

        foreach ($get_roles as $role) {
            $roles[str_replace('-', '_', $role->role->name)] = $role->role->display_name;
        }

        return json_decode(json_encode($roles));
    }
}

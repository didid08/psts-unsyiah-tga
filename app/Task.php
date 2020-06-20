<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'task_value', 'status'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}

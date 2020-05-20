<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTGA extends Model
{
    protected $table = 'data_tga';

    protected $fillable = [
    	'user_id', 'category', 'type', 'name', 'display_name', 'content', 'verified'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    	'key', 'value'
    ];

    public static function get($key) {
    	return Setting::firstWhere('key', $key)->value;
    }
}

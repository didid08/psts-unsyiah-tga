<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function dashboard() {
    	return 'Halo, Ini Admin';
    }
}

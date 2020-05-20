<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Main\Admin\AdminController;

use App\Setting;

class MainController extends Controller
{
    public function customView($viewName, $data = []) {
    	return view('main.'.$viewName, array_merge([
    		'title' => Setting::get('site_title')
    	], $data));
    }

    public static function dashboard() {
    	if (session('auth')['category'] == 'admin') {
    		return AdminController::dashboard();
    	}else {
    		return 'Ini '.session('auth')['category'];
    	}
    }

    public function infoDosen() {

    }

    public function rekapDosen() {

    }
}

<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;

use App\User;

class AdminController extends MainController
{
    public function dashboard()
    {
    	return $this->customView('admin.dashboard', [
            'nav_item_active' => 'dashboard',
            'subtitle' => 'Dashboard',
            'semua_mahasiswa' => User::dataWithCategory('mahasiswa')
        ]);
    }
}

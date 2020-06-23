<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class IndexController extends Controller
{
    public function __invoke()
    {
    	$auth = session('auth');

		if ($auth['category'] == 'mahasiswa')
		{
			return redirect(route('main.tga.disposisi'));
		}
		 else
		{
			return redirect(route('main.dashboard'));
		}
    }
}

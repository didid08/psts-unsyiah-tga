<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
    	$request->session()->flush();
    	return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Setting;

class LoginController extends Controller
{
    public function loginPage($opsi = null, Request $request)
    {
    	if ($opsi == 'tamu') {
    		$request->session()->put('auth', ['category' => 'tamu', 'identity' => null]);
    		return redirect('/')->with('pesan', 'Anda login sebagai Tamu');
    	}
    	return view('auth.login', [
    		'title' => Setting::get('site_title')
    	]);
    }

    public function loginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'password' => 'required'
        ], [
            'identity.required' => 'Harap masukkan NIP/NIM/Username',
            'password.required' => 'Harap masukkan password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $auth = [
            'identity' => $request->input('identity'),
            'password' => $request->input('password')
        ];

    	$identityType = 'nomor_induk';

    	if (preg_match('/[a-z]/i', $auth['identity'])) {
    		$identityType = 'username';
    	}

    	$user = User::firstWhere($identityType, $auth['identity']);

    	if ($user != null) {
    		if (Hash::check($auth['password'], $user->password)) {

    			$request->session()->put('auth', [
    				'category' => $user->category,
    				'identity' => [
    					$identityType => $auth['identity']
    				]
    			]);
    			return redirect('/')->with('pesan', 'Anda telah login');

    		}
    		return redirect()->back()->with('error', 'Anda salah memasukkan password');
    	}
    	return redirect()->back()->with('error', 'Akun tidak ditemukan');
    }
}

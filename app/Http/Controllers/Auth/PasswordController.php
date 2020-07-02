<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class PasswordController extends Controller
{
    public function changePassword ($for = null, Request $request)
    {
    	if ($for != null)
    	{
    		if (User::myData('category') == 'admin')
    		{
    			if (User::where('nomor_induk', $for)->exists())
    			{
    				$validator = Validator::make($request->all(), [
	    				'password' => 'required|min:5|max:30',
	    				'password-repeat' => 'required'
			        ], [
			        	'password.required' => 'Harap masukkan password baru',
			        	'password-repeat.required' => 'Harap ulangi password baru',

			        	'password.min' => 'Panjang minimal password adalah 5 karakter',
			        	'password.max' => 'Panjang maksimal password adalah 30 karakter'
			        ]);

			        if ($validator->fails()) {
			            return redirect()->back()->withErrors($validator);
			        }

			        if ($request->input('password') == $request->input('password-repeat'))
			        {
			        	$user = User::where('nomor_induk', $for);
			        	$user->update([
			        		'password' => Hash::make($request->input('password'))
			        	]);
			        	return redirect()->back()->with('success', 'Sukses mengubah password untuk user ('.ucfirst($user->first()->category).') '.$user->first()->nama.' ('.$user->first()->nomor_induk.') ');
			        }
			        return redirect()->back()->with('error', 'Harap masukkan ulang password dengan benar');
	        	}
	        	return redirect()->back()->with('error', 'User tidak ditemukan');
    		}
    		return redirect()->back()->with('error', 'Anda tidak memiliki perizinan untuk mengubah password user lain');
    	} else {
    		$validator = Validator::make($request->all(), [
    			'old-password' => 'required',
				'password' => 'required|min:5|max:30',
				'password-repeat' => 'required'
	        ], [
	        	'old-password.required' => 'Harap masukkan password lama',
	        	'password.required' => 'Harap masukkan password baru',
	        	'password-repeat.required' => 'Harap ulangi password baru',

	        	'password.min' => 'Panjang minimal password adalah 5 karakter',
	        	'password.max' => 'Panjang maksimal password adalah 30 karakter'
	        ]);

	        if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator);
	        }

	        if (!Hash::check($request->input('old-password'), User::myData('password'))) {
	        	return redirect()->back()->with('error', 'Password lama yang anda masukkan tidak sesuai, jika anda mengalami kesulitan harap hubungi admin');
	        }

	        if ($request->input('password') == $request->input('password-repeat'))
	        {
	        	$user = User::where('id', User::myData('id'));
	        	$user->update([
	        		'password' => Hash::make($request->input('password'))
	        	]);
	        	return redirect()->back()->with('success', 'Sukses mengubah password');
	        }
	        return redirect()->back()->with('error', 'Harap masukkan ulang password baru dengan benar');
    	}
    }
}

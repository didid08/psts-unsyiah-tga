<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Bidang;
use App\User;
use App\Data;
use App\Disposisi;
use App\UserRole;

class AkunController extends MainController
{
    public function view() {
    	return $this->customView('admin.akun', [
            'nav_item_active' => 'akun',
            'subtitle' => 'Akun',
            'semua_dosen' => User::where('category', 'dosen')->orderBy('nomor_induk')->get(),
            'semua_mahasiswa' => User::where('category', 'mahasiswa')->orderBy('nomor_induk')->get()
        ]);
    }

    public function tambahAkun(Request $request)
    {
        $validate_rules = [
        	'category' => 'required',
    		'nama' => 'required',
    		'nomor-induk' => 'required|numeric',
    		'password' => 'required'
        ];

        $validate_errors = [
        	'category.required' => 'Kategori tidak boleh kosong',
        	'nama.required' => 'Nama tidak boleh kosong',
        	'nomor-induk.required' => 'Nomor Induk tidak boleh kosong',
        	'nomor-induk.numeric' => 'Nomor Induk harus berbentuk angka',
        	'password.required' => 'Password tidak boleh kosong'
        ];

        if ($request->has('email')) {
        	if (!empty($request->input('email'))) {
        		$validate_rules['email'] = 'email';
        		$validate_errors['email'] = 'Format Email salah';
        	}
        }

    	$validator = Validator::make($request->all(), $validate_rules, $validate_errors);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        User::insert([
        	'category' => $request->input('category'),
        	'nama' => $request->input('nama'),
        	'nomor_induk' => $request->input('nomor-induk'),
        	'password' => Hash::make($request->input('password'))
        ]);

        $user = User::where(['category' => $request->input('category'), 'nomor_induk' => $request->input('nomor-induk')]);

        if ($request->input('category') == 'mahasiswa') {
        	Disposisi::insert([
        		'user_id' => $user->first()->id
        	]);
        	UserRole::insert([
        		'user_id' => $user->first()->id,
        		'role_id' => 9
        	]);
        } elseif ($request->input('category') == 'dosen') {
        	UserRole::insert([
        		'user_id' => $user->first()->id,
        		'role_id' => 4
        	]);
        	UserRole::insert([
        		'user_id' => $user->first()->id,
        		'role_id' => 6
        	]);
        }

        if ($request->has('email')) {
        	if (!empty($request->input('email'))) {
        		$user->update([
		        	'email' => $request->input('email')
		        ]);
        	}
        }

        return redirect()->back()->with('success', 'Berhasil menambah akun');
    }

    public function editAkun($category, $nomorInduk, Request $request)
    {
    	$user = User::where(['category' => $category, 'nomor_induk' => $nomorInduk]);
        if (!$user->exists()) {
        	return abort(404);
        }

        $validate_rules = [
    		'nama' => 'required',
    		'nomor-induk' => 'required|numeric'
        ];

        $validate_errors = [
        	'nama.required' => 'Nama tidak boleh kosong',
        	'nomor-induk.required' => 'Nomor Induk tidak boleh kosong',
        	'nomor-induk.numeric' => 'Nomor Induk harus berbentuk angka'
        ];

        if ($request->has('email')) {
        	if (!empty($request->input('email'))) {
        		$validate_rules['email'] = 'email';
        		$validate_errors['email'] = 'Format Email salah';
        	}
        }

    	$validator = Validator::make($request->all(), $validate_rules, $validate_errors);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Data::where('content', $user->first()->nama)->update([
        	'content' => $request->input('nama')
        ]);

        $user->update([
        	'nama' => $request->input('nama'),
        	'nomor_induk' => $request->input('nomor-induk')
        ]);

        if ($request->has('email')) {
        	if (!empty($request->input('email'))) {
        		$user->update([
		        	'email' => $request->input('email')
		        ]);
        	}
        }

        if (!empty($request->input('password'))) {
    		$user->update([
	        	'password' => Hash::make($request->input('password'))
	        ]);
    	}

        return redirect()->back()->with('success', 'Berhasil mengedit akun');
    }

    public function hapusAkun($category, $nomorInduk, Request $request)
    {
    	$user = User::where(['category' => $category, 'nomor_induk' => $nomorInduk]);
        if (!$user->exists()) {
        	return abort(404);
        }

        $user->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus akun');
    }

    public function ubahRole($role, $bidang = null, Request $request)
    {
    	if (!in_array($role, ['koor-prodi', 'koor-tga', 'ketua-kel-keahlian'])) {
    		return abort(404);
    	}

    	$validator = Validator::make($request->all(), [
    		'value' => 'required'
    	], [
    		'value.required' => 'Harap pilih dosen yang mau dijadikan '.ucwords(str_replace('-', ' ', $role))
    	]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->input('value') == 'empty') {
        	return redirect()->back()->with('error', 'Harap pilih dosen yang mau dijadikan '.ucwords(str_replace('-', ' ', $role)));
        }

        $user = User::where(['category' => 'dosen', 'nomor_induk' => $request->input('value')]);
        if (!$user->exists()) {
        	return redirect()->back()->with('error', 'Dosen yang anda pilih tidak ditemukan');
        }

        if ($role == 'koor-prodi') {
        	UserRole::updateOrCreate([
        		'role_id' => 2
        	], [
        		'user_id' => $user->first()->id
        	]);
        	return redirect()->back()->with('success', 'Koordinator Prodi berhasil diperbarui');
        } elseif ($role == 'koor-tga') {
        	UserRole::updateOrCreate([
        		'role_id' => 5
        	], [
        		'user_id' => $user->first()->id
        	]);
        	return redirect()->back()->with('success', 'Koordinator TGA berhasil diperbarui');
        } elseif ($role == 'ketua-kel-keahlian') {
        	if (in_array($bidang, [1,2,3,4,5])) {
        		$current_ketua = User::where(['category' => 'dosen', 'bidang_id' => $bidang]);
        		if ($current_ketua->exists()) {
                    //Data::where(['name' => 'ketua-bidang', 'content' => $current_ketua->first()->nama])->update(['content' => $bidang]);
        			UserRole::where(['role_id' => 3, 'user_id' => $current_ketua->first()->id])->delete();
        			$current_ketua->update(['bidang_id' => null]);
        		}
        		$user->update(['bidang_id' => $bidang]);
        		UserRole::insert([
        			'role_id' => 3,
	        		'user_id' => $user->first()->id
	        	]);
                //Data::where(['name' => 'ketua-bidang', 'content' => $bidang])->update(['content' => $current_ketua->first()->nama]);
	        	return redirect()->back()->with('success', 'Ketua Kelompok Keahlian '.Bidang::firstWhere('id', $bidang)->nama.' berhasil diperbarui');
        	}
        	return redirect()->back()->with('error', 'Bidang tidak ditemukan');
        }
    }
}

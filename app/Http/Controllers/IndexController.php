<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class IndexController extends Controller
{
    public function main() {
    	$auth = session('auth');

		if (in_array($auth['category'], array('admin', 'dosen'))) {
			return redirect(route('main.dashboard', ['category' => $auth['category']]));
		}
		else if ($auth['category'] == 'mahasiswa') {

			$administrasiTGA = User::find(User::data('id'))->administrasiTGA();

			if ($administrasiTGA->exists()) {

				if ($administrasiTGA->value('selesai') == true) {
					return redirect(route('main.dashboard', ['category' => $auth['category']]));			
				}
				return redirect(route('main.administrasi-tga', ['category' => 'mahasiswa']));	

			}
			return redirect(route('main.mahasiswa.input-data-tga'));
		}
		else if ($auth['category'] == 'tamu') {
			return redirect(route('main.tamu.informasi-tga'));
		}
    }
}

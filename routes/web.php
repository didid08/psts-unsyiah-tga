<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

	/* INDEX ROUTE */
	Route::get('/', 'IndexController')->name('index');

	/* AUTH ROUTES */
	Route::get('/auth/login/{opsi?}', 'Auth\LoginController@loginPage')->name('auth.login');
	Route::post('/auth/login', 'Auth\LoginController@loginProcess')->name('auth.login.process');
	Route::get('/auth/logout', 'Auth\AuthController@logout')->name('auth.logout');
	Route::put('/auth/password/change/{for?}', 'Auth\PasswordController@changePassword')->middleware('prevent.guest')->name('auth.password.change');

	/* MAIN ROUTES */
	Route::get('/main/dashboard', 'Main\MainController@dashboard')->name('main.dashboard');
	Route::get('/main/dashboard/data', 'Main\Admin\DashboardController@dashboardWithData')->middleware('only.admin')->name('main.dashboard.admin.with-data');
	Route::get('/main/dosen/info', 'Main\MainController@infoDosen')->name('main.dosen.info');
	Route::get('/main/dosen/rekap', 'Main\MainController@rekapDosen')->name('main.dosen.rekap');

		//TGA
		Route::get('/main/tga/disposisi/{nim?}', 'Main\TGA\DisposisiController@view')->middleware('prevent.guest')->name('main.tga.disposisi');
		Route::middleware('only.mahasiswa')->group(function () {
			//Route::post('/main/tga/disposisi/{nim}/{progress}/unggah', 'Main\TGA\DisposisiController@upload')->name('main.tga.disposisi.unggah');
			Route::get('/main/tga/input-usul', 'Main\TGA\Mahasiswa\InputUsulController@view')->name('main.tga.mahasiswa.input-usul');
			Route::put('/main/tga/input-usul', 'Main\TGA\Mahasiswa\InputUsulController@process')->name('main.tga.mahasiswa.input-usul.process');
		});
		Route::get('/main/tga/usulan-tga', 'Main\TGA\Admin\UsulanTGAController@view')->name('main.tga.admin.usulan-tga');
});
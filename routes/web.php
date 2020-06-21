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
	Route::get('/', 'IndexController@main')->name('index');

	/* AUTH ROUTES */
	Route::get('/login/{opsi?}', 'Auth\LoginController@loginPage')->name('auth.login');
	Route::post('/login', 'Auth\LoginController@loginProcess')->name('auth.login.process');
	Route::get('/logout', 'Auth\AuthController@logout')->name('auth.logout');
	Route::put('/auth/password/change/{for?}', 'Auth\PasswordController@changePassword')->middleware('prevent.guest')->name('auth.password.change');

	/* MAIN ROUTES */
	Route::middleware(['redirect'])->group(function () {

		// Semua
		Route::get('/{category}/info-dosen', 'Main\MainController@infoDosen')->name('main.info-dosen');
		Route::get('/{category}/rekap-dosen', 'Main\MainController@rekapDosen')->name('main.rekap-dosen');

		// Semua (Kecuali Tamu)
		Route::middleware(['prevent.guest'])->group(function () {
			Route::get('/{category}/dashboard', 'Main\MainController@dashboard')->name('main.dashboard');
			Route::get('/admin/dashboard/data', 'Main\Admin\AdminController@dashboardWithData')->name('main.dashboard.admin.with-data');
			Route::get('/{category}/tga/administrasi/{nim?}', 'Main\AdministrasiTGA\ViewController')->name('main.administrasi-tga');
			
		});

		// Tamu
		Route::get('/tamu/tga/informasi', 'Main\MainController@dashboard')->name('main.tamu.informasi-tga');

		// Admin
		

		// Dosen
		

		// Mahasiswa
		Route::get('/mahasiswa/tga/input-data', 'Main\Mahasiswa\MahasiswaController@inputDataTGA')->name('main.mahasiswa.input-data-tga');
		Route::put('/mahasiswa/tga/input-data', 'Main\Mahasiswa\MahasiswaController@inputDataTGAProcess')->name('main.mahasiswa.input-data-tga.process');
	});
});
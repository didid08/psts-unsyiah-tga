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

	// Index Route
	Route::get('/', 'IndexController@main')->name('index');

	//Auth Routes
	Route::get('/login/{opsi?}', 'Auth\LoginController@loginPage')->name('auth.login');
	Route::post('/login', 'Auth\LoginController@loginProcess')->name('auth.login.process');
	Route::get('/logout', 'Auth\AuthController@logout')->name('auth.logout');

	//Main Routes
	Route::middleware(['redirect'])->group(function () {

		//Semua
		Route::get('/{category}/dashboard', 'Main\MainController@dashboard')->name('main.dashboard');
		Route::get('/{category}/info-dosen', 'Main\MainController@infoDosen')->name('main.info-dosen');
		Route::get('/{category}/rekap-dosen', 'Main\MainController@rekapDosen')->name('main.rekap-dosen');

		//Admin
		

		//Dosen
		

		//Mahasiswa
		Route::get('/mahasiswa/input-data-tga', 'Main\Mahasiswa\MahasiswaController@inputDataTGA')->name('main.mahasiswa.input-data-tga');
		Route::put('/mahasiswa/input-data-tga', 'Main\Mahasiswa\MahasiswaController@inputDataTGAProcess')->name('main.mahasiswa.input-data-tga.process');
		Route::get('/mahasiswa/administrasi-tga', 'Main\Mahasiswa\MahasiswaController@administrasiTGA')->name('main.mahasiswa.administrasi-tga');

		//Tamu
		Route::get('/tamu/informasi-tga', 'Main\MainController@dashboard')->name('main.tamu.informasi-tga');
	});
});
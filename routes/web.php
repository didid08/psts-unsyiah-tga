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
Route::get('/terima-usul/{name}/{nim}', 'Main\TGA\DisposisiController@terimaUsul')->name('terima-usul');

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

	Route::get('/main/file/{filename}', 'Main\FileGetController')->name('main.file');

		//TGA
		Route::get('/main/tga/disposisi/{nim?}', 'Main\TGA\DisposisiController@view')->middleware('prevent.guest')->name('main.tga.disposisi');
		Route::middleware('only.mahasiswa')->group(function () {
			//Route::post('/main/tga/disposisi/{nim}/{progress}/unggah', 'Main\TGA\DisposisiController@upload')->name('main.tga.disposisi.unggah');
			Route::get('/main/tga/input-usul', 'Main\TGA\Mahasiswa\InputUsulController@view')->name('main.tga.mahasiswa.input-usul');
			Route::post('/main/tga/input-usul', 'Main\TGA\Mahasiswa\InputUsulController@process')->name('main.tga.mahasiswa.input-usul.process');
		});

		Route::put('/main/tga/disposisi/{nim}/update-progress', 'Main\TGA\DisposisiController@updateProgress')->name('main.tga.update-progress');
		
		//Admin
		Route::get('/main/tga/usulan-tga', 'Main\TGA\Admin\UsulanTGAController@view')->name('main.tga.admin.usulan-tga');
		Route::get('/main/tga/usulan-sk-pembimbing', 'Main\TGA\Admin\UsulanSKPembimbingController@view')->name('main.tga.admin.usulan-sk-pembimbing');
		//Koor Prodi
		Route::get('/main/tga/persetujuan-usulan-tga', 'Main\TGA\KoorProdi\PersetujuanUsulanTGAController@view')->name('main.tga.koor-prodi.persetujuan-usulan-tga');
		Route::get('/main/tga/penetapan-sk-pembimbing', 'Main\TGA\KoorProdi\PenetapanSKPembimbingController@view')->name('main.tga.koor-prodi.penetapan-sk-pembimbing');
		//Ketua Kel Keahlian
		Route::get('/main/tga/pengusulan-pembimbing-co', 'Main\TGA\KetuaKelKeahlian\PengusulanPembimbingController@view')->name('main.tga.ketua-kel-keahlian.pengusulan-pembimbing');
		Route::post('/usul/pembimbing-co/{nim}', 'Main\TGA\KetuaKelKeahlian\PengusulanPembimbingController@usul')->name('usul.pembimbing-co');
});
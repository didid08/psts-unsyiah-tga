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

	Route::get('/main/file/{filename}', 'Main\FileGetController')->name('main.file'); //pdf
	//Route::get('/main/file/{filename}/{filetoadd}', 'Main\FileGetController@zip')->name('main.file.zip'); //pdf
		//TGA
		Route::get('/main/tga/disposisi/{nim?}', 'Main\TGA\DisposisiController@view')->middleware('prevent.guest')->name('main.tga.disposisi');
		Route::get('/main/tga/disposisi/{nim}/cetak', 'Main\TGA\DisposisiController@print')->middleware('prevent.guest')->name('main.tga.disposisi.cetak');

		Route::middleware('only.mahasiswa')->group(function () {
			Route::post('/main/tga/disposisi/upload/{progress}/{optional?}', 'Main\TGA\Mahasiswa\UploadDisposisiController')->middleware('prevent.guest')->name('main.tga.mahasiswa.upload-disposisi');

			Route::get('/main/tga/input-usul', 'Main\TGA\Mahasiswa\InputUsulController@view')->name('main.tga.mahasiswa.input-usul');
			Route::post('/main/tga/input-usul', 'Main\TGA\Mahasiswa\InputUsulController@process')->name('main.tga.mahasiswa.input-usul.process');

			Route::get('/main/tga/input-usul-sempro', 'Main\TGA\Mahasiswa\InputUsulSemproController@view')->name('main.tga.mahasiswa.input-usul-sempro');
			Route::post('/main/tga/input-usul-sempro', 'Main\TGA\Mahasiswa\InputUsulSemproController@process')->name('main.tga.mahasiswa.input-usul-sempro.process');

			Route::get('/main/tga/input-usul-sidang', 'Main\TGA\Mahasiswa\InputUsulSidangController@view')->name('main.tga.mahasiswa.input-usul-sidang');
			Route::post('/main/tga/input-usul-sidang', 'Main\TGA\Mahasiswa\InputUsulSidangController@process')->name('main.tga.mahasiswa.input-usul-sidang.process');

			Route::get('/main/tga/input-usul-yudisium', 'Main\TGA\Mahasiswa\InputUsulYudisiumController@view')->name('main.tga.mahasiswa.input-usul-yudisium');
			Route::post('/main/tga/input-usul-yudisium', 'Main\TGA\Mahasiswa\InputUsulYudisiumController@process')->name('main.tga.mahasiswa.input-usul-yudisium.process');
		});
		
		//Admin
		Route::get('/main/tga/admin/usulan-tga', 'Main\TGA\Admin\UsulanTGAController@view')->name('main.tga.admin.usulan-tga');
		Route::post('/main/tga/admin/usulan-tga/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanTGAController@process')->name('main.tga.admin.usulan-tga.process');

		Route::get('/main/tga/admin/usulan-sk-pembimbing', 'Main\TGA\Admin\UsulanSKPembimbingController@view')->name('main.tga.admin.usulan-sk-pembimbing');
		Route::post('/main/tga/admin/usulan-sk-pembimbing/process/{nim}', 'Main\TGA\Admin\UsulanSKPembimbingController@process')->name('main.tga.admin.usulan-sk-pembimbing.process');

		Route::get('/main/tga/admin/usulan-surat-permohonan-tugas-pengambilan-data', 'Main\TGA\Admin\UsulanSuratPermohonanTugasPengambilanDataController@view')->name('main.tga.admin.usulan-sptpd');
		Route::post('/main/tga/admin/usulan-surat-permohonan-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanSuratPermohonanTugasPengambilanDataController@process')->name('main.tga.admin.usulan-sptpd.process');

		Route::get('/main/tga/admin/usulan-surat-tugas-pengambilan-data', 'Main\TGA\Admin\UsulanSuratTugasPengambilanDataController@view')->name('main.tga.admin.usulan-stpd');
		Route::post('/main/tga/admin/usulan-surat-tugas-pengambilan-data/process/{nim}', 'Main\TGA\Admin\UsulanSuratTugasPengambilanDataController@process')->name('main.tga.admin.usulan-stpd.process');

		Route::get('/main/tga/admin/usulan-seminar-proposal', 'Main\TGA\Admin\UsulanSeminarProposalController@view')->name('main.tga.admin.usulan-sempro');
		Route::post('/main/tga/admin/usulan-seminar-proposal/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanSeminarProposalController@process')->name('main.tga.admin.usulan-sempro.process');

		Route::get('/main/tga/admin/usulan-sk-penguji-seminar-proposal', 'Main\TGA\Admin\UsulanSKPengujiSeminarProposalController@view')->name('main.tga.admin.usulan-sk-penguji-sempro');
		Route::post('/main/tga/admin/usulan-sk-penguji-seminar-proposal/process/{nim}', 'Main\TGA\Admin\UsulanSKPengujiSeminarProposalController@process')->name('main.tga.admin.usulan-sk-penguji-sempro.process');

		Route::get('/main/tga/admin/usulan-pengesahan-seminar-proposal', 'Main\TGA\Admin\UsulanPengesahanSeminarProposalController@view')->name('main.tga.admin.usulan-pengesahan-sempro');
		Route::post('/main/tga/admin/usulan-pengesahan-seminar-proposal/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanPengesahanSeminarProposalController@process')->name('main.tga.admin.usulan-pengesahan-sempro.process');

		Route::get('/main/tga/admin/usulan-daftar-hadir-seminar-proposal', 'Main\TGA\Admin\UsulanDaftarHadirSeminarProposalController@view')->name('main.tga.admin.usulan-daftar-hadir-sempro');
		Route::post('/main/tga/admin/usulan-daftar-hadir-seminar-proposal/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanDaftarHadirSeminarProposalController@process')->name('main.tga.admin.usulan-daftar-hadir-sempro.process');

		Route::get('/main/tga/admin/usulan-sidang', 'Main\TGA\Admin\UsulanSidangController@view')->name('main.tga.admin.usulan-sidang');
		Route::post('/main/tga/admin/usulan-sidang/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanSidangController@process')->name('main.tga.admin.usulan-sidang.process');

		Route::get('/main/tga/admin/usulan-sk-penguji-sidang', 'Main\TGA\Admin\UsulanSKPengujiSidangController@view')->name('main.tga.admin.usulan-sk-penguji-sidang');
		Route::post('/main/tga/admin/usulan-sk-penguji-sidang/process/{nim}', 'Main\TGA\Admin\UsulanSKPengujiSidangController@process')->name('main.tga.admin.usulan-sk-penguji-sidang.process');

		Route::get('/main/tga/admin/usulan-pengesahan-sidang', 'Main\TGA\Admin\UsulanPengesahanSidangController@view')->name('main.tga.admin.usulan-pengesahan-sidang');
		Route::post('/main/tga/admin/usulan-pengesahan-sidang/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanPengesahanSidangController@process')->name('main.tga.admin.usulan-pengesahan-sidang.process');

		Route::get('/main/tga/admin/usulan-yudisium', 'Main\TGA\Admin\UsulanYudisiumController@view')->name('main.tga.admin.usulan-yudisium');
		Route::post('/main/tga/admin/usulan-yudisium/process/{nim}/{opsi}', 'Main\TGA\Admin\UsulanYudisiumController@process')->name('main.tga.admin.usulan-yudisium.process');

		//Koor Prodi
		Route::get('/main/tga/koor-prodi/persetujuan-usulan-tga', 'Main\TGA\KoorProdi\PersetujuanUsulanTGAController@view')->name('main.tga.koor-prodi.persetujuan-usulan-tga');
		Route::post('/main/tga/koor-prodi/persetujuan-usulan-tga/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PersetujuanUsulanTGAController@process')->name('main.tga.koor-prodi.persetujuan-usulan-tga.process');

		Route::get('/main/tga/koor-prodi/penetapan-sk-pembimbing', 'Main\TGA\KoorProdi\PenetapanSKPembimbingController@view')->name('main.tga.koor-prodi.penetapan-sk-pembimbing');
		Route::post('/main/tga/koor-prodi/penetapan-sk-pembimbing/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PenetapanSKPembimbingController@process')->name('main.tga.koor-prodi.penetapan-sk-pembimbing.process');

		Route::get('/main/tga/koor-prodi/persetujuan-surat-permohonan-tugas-pengambilan-data', 'Main\TGA\KoorProdi\PersetujuanSuratPermohonanTugasPengambilanDataController@view')->name('main.tga.koor-prodi.persetujuan-sptpd');
		Route::post('/main/tga/koor-prodi/persetujuan-surat-permohonan-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PersetujuanSuratPermohonanTugasPengambilanDataController@process')->name('main.tga.koor-prodi.persetujuan-sptpd.process');

		Route::get('/main/tga/koor-prodi/persetujuan-surat-tugas-pengambilan-data', 'Main\TGA\KoorProdi\PersetujuanSuratTugasPengambilanDataController@view')->name('main.tga.koor-prodi.persetujuan-stpd');
		Route::post('/main/tga/koor-prodi/persetujuan-surat-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PersetujuanSuratTugasPengambilanDataController@process')->name('main.tga.koor-prodi.persetujuan-stpd.process');

		Route::get('/main/tga/koor-prodi/penetapan-sk-penguji-sempro', 'Main\TGA\KoorProdi\PenetapanSKPengujiSeminarProposalController@view')->name('main.tga.koor-prodi.penetapan-sk-penguji-sempro');
		Route::post('/main/tga/koor-prodi/penetapan-sk-penguji-sempro/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PenetapanSKPengujiSeminarProposalController@process')->name('main.tga.koor-prodi.penetapan-sk-penguji-sempro.process');

		Route::get('/main/tga/koor-prodi/pengesahan-seminar-proposal', 'Main\TGA\KoorProdi\PengesahanSeminarProposalController@view')->name('main.tga.koor-prodi.pengesahan-sempro');
		Route::post('/main/tga/koor-prodi/pengesahan-seminar-proposal/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PengesahanSeminarProposalController@process')->name('main.tga.koor-prodi.pengesahan-sempro.process');

		Route::get('/main/tga/koor-prodi/penetapan-sk-penguji-sidang', 'Main\TGA\KoorProdi\PenetapanSKPengujiSidangController@view')->name('main.tga.koor-prodi.penetapan-sk-penguji-sidang');
		Route::post('/main/tga/koor-prodi/penetapan-sk-penguji-sidang/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PenetapanSKPengujiSidangController@process')->name('main.tga.koor-prodi.penetapan-sk-penguji-sidang.process');

		Route::get('/main/tga/koor-prodi/pengesahan-sidang', 'Main\TGA\KoorProdi\PengesahanSidangController@view')->name('main.tga.koor-prodi.pengesahan-sidang');
		Route::post('/main/tga/koor-prodi/pengesahan-sidang/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PengesahanSidangController@process')->name('main.tga.koor-prodi.pengesahan-sidang.process');

		Route::get('/main/tga/koor-prodi/pengesahan-usulan-yudisium', 'Main\TGA\KoorProdi\PengesahanUsulanYudisiumController@view')->name('main.tga.koor-prodi.pengesahan-usulan-yudisium');
		Route::post('/main/tga/koor-prodi/pengesahan-usulan-yudisium/process/{nim}/{opsi}', 'Main\TGA\KoorProdi\PengesahanUsulanYudisiumController@process')->name('main.tga.koor-prodi.pengesahan-usulan-yudisium.process');

		//Ketua Kel Keahlian
		Route::get('/main/tga/ketua-kel-keahlian/pengusulan-pembimbing-co', 'Main\TGA\KetuaKelKeahlian\PengusulanPembimbingController@view')->name('main.tga.ketua-kel-keahlian.pengusulan-pembimbing');
		Route::post('/main/tga/ketua-kel-keahlian/pengusulan-pembimbing-co/process/{nim}', 'Main\TGA\KetuaKelKeahlian\PengusulanPembimbingController@process')->name('main.tga.ketua-kel-keahlian.pengusulan-pembimbing.process');
		Route::post('/usul/pembimbing-co/{nim}', 'Main\TGA\KetuaKelKeahlian\PengusulanPembimbingController@usul')->name('usul.pembimbing-co');

		//Pembimbing Co
		Route::get('/main/tga/pembimbing/persetujuan-seminar-dan-sidang', 'Main\TGA\PembimbingCo\PersetujuanSeminarDanSidangController@view')->name('main.tga.pembimbing-co.persetujuan-seminar-dan-sidang');
		Route::post('/main/tga/pembimbing/persetujuan-seminar-dan-sidang/process/{nim}/{type}/{opsi?}', 'Main\TGA\PembimbingCo\PersetujuanSeminarDanSidangController@process')->name('main.tga.pembimbing-co.persetujuan-seminar-dan-sidang.process');

		//Koor TGA
		Route::get('/main/tga/koor-tga/usulan-seminar-proposal', 'Main\TGA\KoorTGA\UsulanSeminarProposalController@view')->name('main.tga.koor-tga.usulan-sempro');
		Route::post('/main/tga/koor-tga/usulan-seminar-proposal/process/{nim}/{opsi}', 'Main\TGA\KoorTGA\UsulanSeminarProposalController@process')->name('main.tga.koor-tga.usulan-sempro.process');

		Route::get('/main/tga/koor-tga/usulan-sidang', 'Main\TGA\KoorTGA\UsulanSidangController@view')->name('main.tga.koor-tga.usulan-sidang');
		Route::post('/main/tga/koor-tga/usulan-sidang/process/{nim}/{opsi}', 'Main\TGA\KoorTGA\UsulanSidangController@process')->name('main.tga.koor-tga.usulan-sidang.process');

		//Komisi Penguji
		Route::get('/main/tga/komisi-penguji/seminar-sidang', 'Main\TGA\KomisiPenguji\SeminarSidangController@view')->name('main.tga.komisi-penguji.seminar-sidang');
		Route::post('/main/tga/komisi-penguji/seminar-sidang/mark-done/{nim}/{type}', 'Main\TGA\KomisiPenguji\SeminarSidangController@markDone')->name('main.tga.komisi-penguji.seminar-sidang.mark-done');
});
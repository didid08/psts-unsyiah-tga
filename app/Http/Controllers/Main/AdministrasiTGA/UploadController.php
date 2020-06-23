<?php

namespace App\Http\Controllers\Main\AdministrasiTGA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function __invoke($category, $nim, $progress, Request $request)
    {
    	$validator = Validator::make($request->all(), $this->validation($progress)['rules'], $this->validation($progress)['errors']);

    	if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = [];
        $file = [];

        foreach ($this->validation($progress)['rules'] as $index => $value) {
        	if (strpos($value, 'file')) {
        		$file[$index] = $request->file($index);
        	} else {
        		$input[$index] = $request->input($index);
        	}
        }

        dd($file);
    }

    public function validation($progress)
    {
    	$validate_rules = [];
    	$validate_errors = [];

    	switch ($progress) {
    		case '1':
    			$validate_rules = [
    				'spp' => 'required|file|mimes:pdf|max:5120',
    				'krs' => 'required|file|mimes:pdf|max:5120',
    				'transkrip-sementara' => 'required|file|mimes:pdf|max:5120',
    				'khs' => 'required|file|mimes:pdf|max:5120'
    			];
    			$validate_errors = [
    				'spp.required' => 'SPP tidak ditemukan',
    				'krs.required' => 'KRS tidak ditemukan',
    				'transkrip-sementara.required' => 'Transkrip Sementara tidak ditemukan',
    				'khs.required' => 'KHS tidak ditemukan',

    				'spp.mimes' => 'SPP yang anda unggah tidak berbentuk pdf',
    				'krs.mimes' => 'KRS yang anda unggah tidak berbentuk pdf',
    				'transkrip-sementara.mimes' => 'Transkrip Sementara yang anda unggah tidak berbentuk pdf',
    				'khs.mimes' => 'KHS yang anda unggah tidak berbentuk pdf',

    				'spp.max' => 'Ukuran SPP melebihi 5 MB',
    				'krs.max' => 'Ukuran KRS melebihi 5 MB',
    				'transkrip-sementara.max' => 'Ukuran Transkrip Sementara melebihi 5 MB',
    				'khs.max' => 'Ukuran KHS melebihi 5 MB'
    			];
    		break;

    		case 'optional-1':
    			$validate_rules = [
    				'sptpd' => 'required|file|mimes:pdf|max:5120'
    			];
    			$validate_errors = [
    				'sptpd.required' => 'Berkas tidak ditemukan',
					'sptpd.mimes' => 'Berkas yang anda unggah tidak berbentuk pdf',
					'sptpd.max' => 'Ukuran berkas melebihi 5 MB'
    			];
    		break;

    		case '8':
    			$validate_rules = [
    				'lembar-asistensi' => 'required|file|mimes:pdf|max:5120',
    				'draft-buku-proposal' => 'required|file|mimes:pdf|max:5120'
    			];
    			$validate_errors = [
    				'lembar-asistensi.required' => 'Lembar Asistensi tidak ditemukan',
    				'lembar-asistensi.mimes' => 'Lembar Asistensi yang anda unggah tidak berbentuk pdf',
    				'lembar-asistensi.max' => 'Ukuran Lembar Asistensi melebihi 5 MB',

    				'draft-buku-proposal.required' => 'Draft Buku Proposal tidak ditemukan',
					'draft-buku-proposal.mimes' => 'Draft Buku Proposal yang anda unggah tidak berbentuk pdf',
					'draft-buku-proposal.max' => 'Ukuran Draft Buku Proposal melebihi 5 MB'
    			];
    		break;

    		case '15':
    			$validate_rules = [
    				'berita-acara-seminar-proposal' => 'required|file|mimes:pdf|max:5120',
    				'buku-proposal' => 'required|file|mimes:pdf|max:5120'
    			];
    			$validate_errors = [
    				'berita-acara-seminar-proposal.required' => 'Berita Acara Seminar Proposal tidak ditemukan',
    				'berita-acara-seminar-proposal.mimes' => 'Berita Acara Seminar Proposal yang anda unggah tidak berbentuk pdf',
    				'berita-acara-seminar-proposal.max' => 'Ukuran Berita Acara Seminar Proposal melebihi 5 MB',

    				'buku-proposal.required' => 'Buku Proposal tidak ditemukan',
					'buku-proposal.mimes' => 'Buku Proposal yang anda unggah tidak berbentuk pdf',
					'buku-proposal.max' => 'Ukuran Buku Proposal melebihi 5 MB'
    			];
    		break;

    		case '18':
    			$validate_rules = [
    				'kelengkapan-dokumen-administrasi-seminar-proposal' => 'required|file|mimes:zip|max:10240'
    			];
    			$validate_errors = [
    				'kelengkapan-dokumen-administrasi-seminar-proposal.required' => 'Berkas tidak ditemukan',
    				'kelengkapan-dokumen-administrasi-seminar-proposal.mimes' => 'Berkas yang anda unggah tidak berbentuk zip',
    				'kelengkapan-dokumen-administrasi-seminar-proposal.max' => 'Ukuran berkas melebihi 10 MB'
    			];
    		break;

    		case '21':
    			$validate_rules = [
    				'lembar-asistensi-2' => 'required|file|mimes:pdf|max:5120',
    				'draft-buku-proposal' => 'required|file|mimes:pdf|max:5120'
    			];
    			$validate_errors = [
    				'lembar-asistensi-2.required' => 'Lembar Asistensi tidak ditemukan',
    				'lembar-asistensi-2.mimes' => 'Lembar Asistensi yang anda unggah tidak berbentuk pdf',
    				'lembar-asistensi-2.max' => 'Ukuran Lembar Asistensi melebihi 5 MB',

    				'draft-buku-tga.required' => 'Draft Buku TGA tidak ditemukan',
					'draft-buku-tga.mimes' => 'Draft Buku TGA yang anda unggah tidak berbentuk pdf',
					'draft-buku-tga.max' => 'Ukuran Draft Buku TGA melebihi 5 MB'
    			];
    		break;

    		case '28':
    			$validate_rules = [
    				'berita-acara-sidang-buku' => 'required|file|mimes:pdf|max:5120',
    				'buku-tga' => 'required|file|mimes:pdf|max:5120'
    			];
    			$validate_errors = [
    				'berita-acara-sidang-buku.required' => 'Berita Acara Sidang Buku tidak ditemukan',
    				'berita-acara-sidang-buku.mimes' => 'Berita Acara Sidang Buku yang anda unggah tidak berbentuk pdf',
    				'berita-acara-sidang-buku.max' => 'Ukuran Berita Acara Sidang Buku melebihi 5 MB',

    				'buku-tga.required' => 'Buku TGA tidak ditemukan',
					'buku-tga.mimes' => 'Buku TGA yang anda unggah tidak berbentuk pdf',
					'buku-tga.max' => 'Ukuran Buku TGA melebihi 5 MB'
    			];
    		break;

			case '31':
    			$validate_rules = [
    				'lembar-pengesahan-dan-buku-laporan-kp' => 'required|file|mimes:zip|max:10240'
    			];
    			$validate_errors = [
    				'lembar-pengesahan-dan-buku-laporan-kp.required' => 'Berkas tidak ditemukan',
    				'lembar-pengesahan-dan-buku-laporan-kp.mimes' => 'Berkas yang anda unggah tidak berbentuk zip',
    				'lembar-pengesahan-dan-buku-laporan-kp.max' => 'Ukuran berkas melebihi 10 MB'
    			];
    		break;

    		case '34':
    			$validate_rules = [
    				'kelengkapan-dokumen-administrasi-sidang-buku' => 'required|file|mimes:zip|max:10240',
    				'kelengkapan-dokumen-yudisium-dan-wisuda' => 'required|file|mimes:zip|max:10240'
    			];
    			$validate_errors = [
    				'kelengkapan-dokumen-administrasi-sidang-buku.required' => 'Kelengkapan Dokumen Administrasi Sidang Buku tidak ditemukan',
    				'kelengkapan-dokumen-administrasi-sidang-buku.mimes' => 'Kelengkapan Dokumen Administrasi Sidang Buku yang anda unggah tidak berbentuk zip',
    				'kelengkapan-dokumen-administrasi-sidang-buku.max' => 'Ukuran Kelengkapan Dokumen Administrasi Sidang Buku melebihi 10 MB',

    				'kelengkapan-dokumen-yudisium-dan-wisuda.required' => 'Kelengkapan Dokumen Yudisium dan Wisuda tidak ditemukan',
    				'kelengkapan-dokumen-yudisium-dan-wisuda.mimes' => 'Kelengkapan Dokumen Yudisium dan Wisuda yang anda unggah tidak berbentuk zip',
    				'kelengkapan-dokumen-yudisium-dan-wisuda.max' => 'Ukuran Kelengkapan Dokumen Yudisium dan Wisuda melebihi 10 MB'
    			];
    		break;

    		default:
    			return abort(404);
    	}

    	return ['rules' => $validate_rules, 'errors' => $validate_errors];
    }
}

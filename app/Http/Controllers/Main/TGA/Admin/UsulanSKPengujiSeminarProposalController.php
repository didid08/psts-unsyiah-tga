<?php

namespace App\Http\Controllers\Main\TGA\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;

class UsulanSKPengujiSeminarProposalController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-sk-penguji-seminar-proposal', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan SK Penguji Seminar Proposal',

            'semua_mahasiswa' => Disposisi::where('progress', 11)->orderBy('updated_at')->get(),
            'jumlah_asistensi' => $data->getDataMultiple('jumlah-asistensi'),
            'masa_pembimbingan_proposal' => $data->getDataMultiple('masa-pembimbingan-proposal'),
            'lembar_asistensi' => $data->getDataMultiple('lembar-asistensi'),
            'draft_buku_proposal' => $data->getDataMultiple('draft-buku-proposal')
        ]);
    }

    public function process($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$validate_rules = [
            'sk-penguji-sempro' => 'required|file|mimes:pdf|max:5120',
            'undangan-sempro' => 'required|file|mimes:pdf|max:5120',
            'berkas-seminar-lainnya' => 'required|file|mimes:pdf|max:5120'
        ];
        $validate_errors = [
            'sk-penguji-sempro.required' => 'Harap unggah SK Penguji Sempro',
            'sk-penguji-sempro.mimes' => 'Harap unggah dalam format pdf',
            'sk-penguji-sempro.max' => 'Ukuran SK Penguji Sempro melebihi 5 MB',

            'undangan-sempro.required' => 'Harap unggah Undangan Sempro',
            'undangan-sempro.mimes' => 'Harap unggah dalam format pdf',
            'undangan-sempro.max' => 'Ukuran Undangan Sempro melebihi 5 MB',

            'berkas-seminar-lainnya.required' => 'Harap unggah Berkas Seminar Lainnya',
            'berkas-seminar-lainnya.mimes' => 'Harap unggah dalam format pdf',
            'berkas-seminar-lainnya.max' => 'Ukuran Berkas Seminar Lainnya melebihi 5 MB'
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $filename1 = $nim.'-sk-penguji-sempro.'.$request->file('sk-penguji-sempro')->extension();
        $filename2 = $nim.'-undangan-sempro.'.$request->file('undangan-sempro')->extension();
        $filename3 = $nim.'-berkas-seminar-lainnya.'.$request->file('berkas-seminar-lainnya')->extension();
        
        $request->file('sk-penguji-sempro')->storeAs(
            'data', $filename1
        );
        $request->file('undangan-sempro')->storeAs(
            'data', $filename2
        );
        $request->file('berkas-seminar-lainnya')->storeAs(
            'data', $filename3
        );

        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul_sempro',
            'type' => 'file',
            'name' => 'sk-penguji-sempro',
            'display_name' => 'SK Penguji Sempro'
        ], [
            'content' => $filename1
        ]);
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul_sempro',
            'type' => 'file',
            'name' => 'undangan-sempro',
            'display_name' => 'Undangan Seminar Proposal'
        ], [
            'content' => $filename2
        ]);
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul_sempro',
            'type' => 'file',
            'name' => 'berkas-seminar-lainnya',
            'display_name' => 'Berkas Seminar Lainnya'
        ], [
            'content' => $filename3
        ]);

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
	
        $disposisi->update([
            'progress' => 12
        ]);

        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    }
}

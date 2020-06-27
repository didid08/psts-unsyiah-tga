<?php

namespace App\Http\Controllers\Main\TGA\Mahasiswa;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Disposisi;
use App\Data;

class InputUsulSemproController extends MainController
{
    public function view ()
    {
    	$progress = Disposisi::firstWhere('user_id', User::myData('id'))->progress;
    	
    	if ($progress < 8) {
    		return redirect()->back()->with('error', 'Anda belum menyelesaikan tahap 4');
    	}

    	$data = new Data();

    	$input_value = [
            'jumlah-asistensi' => $data->getSingleData(User::myData('id'), 'jumlah-asistensi')->content,
            'masa-pembimbingan-proposal' => $data->getSingleData(User::myData('id'), 'masa-pembimbingan-proposal')->content
        ];

        return $this->customView('tga.mahasiswa.input-usul-sempro', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Input Usul Sempro',
            'input_value' => $input_value,
            'progress' => $progress
        ]);
    }

    public function process (Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'lembar-asistensi' => 'required|file|mimes:pdf|max:5120',
    		'draft-buku-proposal' => 'required|file|mimes:pdf|max:5120'
    	], [
    		'lembar-asistensi.required' => 'Harap unggah Lembar Asistensi',
            'lembar-asistensi.mimes' => 'Lembar Asistensi yang anda unggah tidak berbentuk pdf',
            'lembar-asistensi.max' => 'Ukuran Lembar Asistensi melebihi 5 MB',
            'draft-buku-proposal.required' => 'Harap unggah Draft Buku Proposal',
            'draft-buku-proposal.mimes' => 'Draft Buku Proposal yang anda unggah tidak berbentuk pdf',
            'draft-buku-proposal.max' => 'Ukuran Draft Buku Proposal melebihi 5 MB'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $lembar_asistensi_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-lembar-asistensi.'.$request->file('lembar-asistensi')->extension();
        $draft_buku_proposal_filename = User::firstWhere('id', User::myData('id'))->nomor_induk.'-draft-buku-proposal.'.$request->file('draft-buku-proposal')->extension();
        
        $request->file('lembar-asistensi')->storeAs(
            'data', $lembar_asistensi_filename
        );
        $request->file('draft-buku-proposal')->storeAs(
            'data', $draft_buku_proposal_filename
        );

        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_usul_sempro',
            'type' => 'file',
            'name' => 'lembar-asistensi',
            'display_name' => 'Lembar Asistensi'
        ], [
            'content' => $lembar_asistensi_filename
        ]);
        Data::updateOrCreate([
            'user_id' => User::myData('id'),
            'category' => 'data_usul_sempro',
            'type' => 'file',
            'name' => 'draft-buku-proposal',
            'display_name' => 'Draft Buku Proposal'
        ], [
            'content' => $draft_buku_proposal_filename
        ]);

        Disposisi::where('user_id', User::myData('id'))->update([
            'progress' => 9
        ]);

        return redirect(route('main.tga.disposisi'))->with('success', 'Data usul sempro berhasil disimpan');
    }
}

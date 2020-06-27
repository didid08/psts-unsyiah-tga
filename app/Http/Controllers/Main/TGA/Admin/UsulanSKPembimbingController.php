<?php

namespace App\Http\Controllers\Main\TGA\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Data;
use App\Disposisi;
use App\User;

class UsulanSKPembimbingController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('tga.admin.usulan-sk-pembimbing', [
            'nav_item_active' => 'tga',
            'subtitle' => 'Usulan SK Pembimbing',

            'semua_mahasiswa' => Disposisi::where('progress', 5)->orderBy('updated_at')->get(),
            'pembimbing' => $data->getDataMultiple('pembimbing'),
            'co_pembimbing' => $data->getDataMultiple('co-pembimbing')
        ]);
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $validate_rules = [
            'sk-pembimbing' => 'required|file|mimes:pdf|max:5120'
        ];
        $validate_errors = [
            'sk-pembimbing.required' => 'Harap unggah SK Penunjukan Pembimbing',
            'sk-pembimbing.mimes' => 'Harap unggah dalam format pdf',
            'sk-pembimbing.max' => 'Ukuran SK Penunjukan Pembimbing melebihi 5 MB'
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $ext = $request->file('sk-pembimbing')->extension();
        $filename = $nim.'-sk-pembimbing.'.$ext;
        $request->file('sk-pembimbing')->storeAs(
            'data', $filename
        );
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul',
            'type' => 'file',
            'name' => 'sk-pembimbing',
            'display_name' => 'SK Penunjukan Pembimbing'
        ], [
            'content' => $filename
        ]);

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        $disposisi->update([
            'progress' => 6
        ]);

        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    }
}

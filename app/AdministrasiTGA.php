<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\UserRole;
use App\DataTGA;

class AdministrasiTGA extends Model
{
    protected $table = 'administrasi_tga';

    protected $fillable = [
    	'progress', 'repeat', 'progress_optional', 'repeat_optional'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isEligibleToView($nim, $myname)
    {
    	$user_role = new UserRole();
    	$my_roles = $user_role->myRoles();
    	if (isset($my_roles->admin) | isset($my_roles->koor_prodi) | isset($my_roles->koor_tga) | isset($my_roles->ketua_jurusan) | isset($my_roles->sek_jurusan)) {
    		return true;
    	} else {
    		$mhs_id = User::firstWhere('nomor_induk', $nim)->id;
    		$data_tga = new DataTGA ();

    		$mhs_ketua_bidang = null;
    		$mhs_pembimbing = null;
    		$mhs_co_pembimbing = null;
    		$mhs_komisi_penguji = [];

    		if ($data_tga->checkSingleData($mhs_id, 'ketua-bidang')) {
				$mhs_ketua_bidang = $data_tga->getSingleData($mhs_id, 'ketua-bidang')->content;
    		}

    		if ($data_tga->checkSingleData($mhs_id, 'nama-pembimbing')) {
				$mhs_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-pembimbing')->content;
    		}

    		if ($data_tga->checkSingleData($mhs_id, 'nama-co-pembimbing')) {
				$mhs_co_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->content;
    		}

    		if ($data_tga->checkSingleData($mhs_id, 'komisi-penguji')) {
				$mhs_komisi_penguji = json_decode(json_encode($data_tga->getSingleData($mhs_id, 'komisi-penguji')->content), true);
    		}

			if ($myname == $mhs_ketua_bidang | $myname == $mhs_pembimbing | $myname == $mhs_co_pembimbing | in_array($myname, $mhs_komisi_penguji)) {
				return true;
			}
			return false;
    	}
    }

    public function isPembimbing($nim, $myname)
    {
        $mhs_id = User::firstWhere('nomor_induk', $nim)->id;
        $data_tga = new DataTGA ();

        $mhs_pembimbing = null;
        $mhs_co_pembimbing = null;

        if ($data_tga->checkSingleData($mhs_id, 'nama-pembimbing')) {
            $mhs_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-pembimbing')->content;
        }

        if ($data_tga->checkSingleData($mhs_id, 'nama-co-pembimbing')) {
            $mhs_co_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->content;
        }

        if ($myname == $mhs_pembimbing | $myname == $mhs_co_pembimbing) {
            return true;
        }
        return false;
    }

    public function list() {
    	$result = [];
    	foreach ($this->get() as $mhs) {
    		if ($this->isEligibleToView($mhs->user->nomor_induk, User::data('nama'))) {
    			array_push($result, ['nama' => $mhs->user->nama, 'nim' => $mhs->user->nomor_induk]);
    		}
    	}
    	return json_decode(json_encode($result));
    }
}

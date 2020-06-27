<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\UserRole;
use App\Data;

class Disposisi extends Model
{
    protected $table = 'disposisi';

    protected $fillable = [
    	'progress', 'progress_optional', 'no_disposisi', 'tgl_disposisi'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isEligibleToView($mhs_id, $myname)
    {
    	$user_role = new UserRole();
    	$my_roles = $user_role->myRoles();
    	if (isset($my_roles->admin) | isset($my_roles->koor_prodi) | isset($my_roles->koor_tga) | isset($my_roles->ketua_jurusan) | isset($my_roles->sek_jurusan)) {
    		return true;
    	} else {
    		$data_tga = new Data ();

    		$mhs_ketua_bidang = null;
    		$mhs_pembimbing = null;
    		$mhs_co_pembimbing = null;
    		$mhs_ketua_penguji = null;
            $mhs_penguji_1 = null;
            $mhs_penguji_2 = null;
            $mhs_penguji_3 = null;

    		if ($data_tga->checkSingleData($mhs_id, 'ketua-bidang')) {
                if ($data_tga->getSingleData($mhs_id, 'ketua-bidang')->verified == true) {
				    $mhs_ketua_bidang = $data_tga->getSingleData($mhs_id, 'ketua-bidang')->content;
                }
    		}

    		if ($data_tga->checkSingleData($mhs_id, 'nama-pembimbing')) {
                if ($data_tga->getSingleData($mhs_id, 'nama-pembimbing')->verified == true) {
				    $mhs_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-pembimbing')->content;
                }
    		}

    		if ($data_tga->checkSingleData($mhs_id, 'nama-co-pembimbing')) {
				if ($data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->verified == true) {
                    $mhs_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->content;
                }
    		}

    		if ($data_tga->checkSingleData($mhs_id, 'ketua-penguji')) {
                if ($data_tga->getSingleData($mhs_id, 'ketua-penguji')->verified == true) {
                    $mhs_ketua_penguji = $data_tga->getSingleData($mhs_id, 'ketua-penguji')->content;
                }
    		}

            if ($data_tga->checkSingleData($mhs_id, 'penguji-1')) {
                if ($data_tga->getSingleData($mhs_id, 'penguji-1')->verified == true) {
                    $mhs_ketua_penguji = $data_tga->getSingleData($mhs_id, 'penguji-1')->content;
                }
            }

            if ($data_tga->checkSingleData($mhs_id, 'penguji-2')) {
                if ($data_tga->getSingleData($mhs_id, 'penguji-2')->verified == true) {
                    $mhs_ketua_penguji = $data_tga->getSingleData($mhs_id, 'penguji-2')->content;
                }
            }

            if ($data_tga->checkSingleData($mhs_id, 'penguji-3')) {
                if ($data_tga->getSingleData($mhs_id, 'penguji-3')->verified == true) {
                    $mhs_ketua_penguji = $data_tga->getSingleData($mhs_id, 'penguji-3')->content;
                }
            }

			if ($myname == $mhs_ketua_bidang | $myname == $mhs_pembimbing | $myname == $mhs_co_pembimbing | $myname == $mhs_ketua_penguji | $myname == $mhs_penguji_1 | $myname == $mhs_penguji_2 | $myname == $mhs_penguji_3) {
				return true;
			}
			return false;
    	}
    }

    public function isPembimbing($mhs_id, $myname)
    {
        $data_tga = new Data ();

        $mhs_pembimbing = null;
        $mhs_co_pembimbing = null;

        if ($data_tga->checkSingleData($mhs_id, 'nama-pembimbing')) {
            if ($data_tga->getSingleData($mhs_id, 'nama-pembimbing')->verified == true) {
                $mhs_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-pembimbing')->content;
            }
        }

        if ($data_tga->checkSingleData($mhs_id, 'nama-co-pembimbing')) {
            if ($data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->verified == true) {
                $mhs_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->content;
            }
        }

        if ($myname == $mhs_pembimbing | $myname == $mhs_co_pembimbing) {
            return true;
        }
        return false;
    }

    public function isKetuaPenguji($mhs_id, $myname)
    {
        $data_tga = new Data ();

        $ketua_penguji = null;

        if ($data_tga->checkSingleData($mhs_id, 'ketua-penguji')) {
            if ($data_tga->getSingleData($mhs_id, 'ketua-penguji')->verified == true) {
                $ketua_penguji = $data_tga->getSingleData($mhs_id, 'ketua-penguji')->content;
            }
        }

        if ($myname == $ketua_penguji) {
            return true;
        }
        return false;
    }

    public function list() {
    	$result = [];
    	foreach ($this->get() as $mhs) {
    		array_push($result, ['nama' => $mhs->user->nama, 'nim' => $mhs->user->nomor_induk]);
    	}
    	return json_decode(json_encode($result));
    }

    public function isAllKomisiPengujiAccepted ($mhs_id)
    {
        $data_tga = new Data ();

        $ketua_penguji = false;
        $penguji_1 = false;
        $penguji_2 = false;
        $penguji_3 = false;

        if ($data_tga->checkSingleData($mhs_id, 'ketua-penguji') && $data_tga->checkSingleData($mhs_id, 'penguji-1') && $data_tga->checkSingleData($mhs_id, 'penguji-2') && $data_tga->checkSingleData($mhs_id, 'penguji-3')) {
            $ketua_penguji = $data_tga->getSingleData($mhs_id, 'ketua-penguji')->verified;
            $penguji_1 = $data_tga->getSingleData($mhs_id, 'penguji-1')->verified;
            $penguji_2 = $data_tga->getSingleData($mhs_id, 'penguji-2')->verified;
            $penguji_3 = $data_tga->getSingleData($mhs_id, 'penguji-3')->verified;
        }

        if ($ketua_penguji == true && $penguji_1 == true && $penguji_2 == true && $penguji_3 == true) {
            return true;
        }
        return false;
    }

    public function isAllPembimbingAccepted ($mhs_id)
    {
        $data_tga = new Data ();

        $pembimbing = false;
        $co_pembimbing = false;

        if ($data_tga->checkSingleData($mhs_id, 'nama-pembimbing') && $data_tga->checkSingleData($mhs_id, 'nama-co-pembimbing')) {
            $pembimbing = $data_tga->getSingleData($mhs_id, 'nama-pembimbing')->verified;
            $co_pembimbing = $data_tga->getSingleData($mhs_id, 'nama-co-pembimbing')->verified;
        }

        if ($pembimbing == true && $co_pembimbing == true) {
            return true;
        }
        return false;
    }

    public function isAccepted ($mhs_id, $role) //pembimbing dann komisi penguji
    {
        $data_tga = new Data ();

        $result = false;

        if ($data_tga->checkSingleData($mhs_id, $role)) {
            $result = $data_tga->getSingleData($mhs_id, $role)->verified;
        }

        return $result;
    }

    public function isTemporary($mhs_id, $data) {
        $data_tga = new Data ();

        $result = false;

        if ($data_tga->checkSingleData($mhs_id, $data)) {
            $result = $data_tga->getSingleData($mhs_id, $data)->temporary;
        }

        return $result;
    }
}

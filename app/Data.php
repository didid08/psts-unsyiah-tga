<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = [
    	'user_id', 'category', 'type', 'name', 'display_name', 'content', 'no', 'tgl', 'verified', 'verification_key'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getDataMultiple($name) // Mengambil data yang sama secara multiple
    {
        $final_data = [];
        $all_data = $this->where('name', $name)->get();

        foreach ($all_data as $data) {
            $final_data[$data->user_id] = [
                'user_id' => $data->user_id,
                'category' => $data->category,
                'type' => $data->type,
                'display_name' => $data->display_name,
                'content' => $data->content,
                'no' => $data->no,
                'tgl' => $data->tgl,
                'verified' => $data->verified,
                'updated_at' => $data->updated_at,
                'no' => $data->no,
                'tgl' => $data->tgl
            ];
        }
        return json_decode(json_encode($final_data));   
    }

    public function listData($user_id)
    {
    	$final_data = [];
    	$all_data = $this->where('user_id', $user_id)->get();

    	foreach ($all_data as $data) {
			$final_data[str_replace('-', '_', $data->name)] = [
				'category' => $data->category,
				'type' => $data->type,
				'display_name' => $data->display_name,
				'content' => $data->content,
                'no' => $data->no,
                'tgl' => $data->tgl,
				'verified' => $data->verified,
                'updated_at' => $data->updated_at,
                'no' => $data->no,
                'tgl' => $data->tgl
			];
		}
    	return json_decode(json_encode($final_data));
    }

    public function getSingleData($mhs_id, $name) {
        $data = $this->where(['user_id' => $mhs_id, 'name' => $name]);

        if ($data->exists()) {
            return $data->first();
        }
        return false;
    }

    public function checkSingleData($mhs_id, $name) {
        if ($this->where(['user_id' => $mhs_id, 'name' => $name])->exists()) {
            return true;
        }
        return false;
    }

    public function checkMultipleData($mhs_id, $list_data) {
        $boolean = [];

        foreach($list_data as $index => $value) {
            if ($this->where(['user_id' => $mhs_id, 'name' => $value])->exists()) {
                array_push($boolean, true);
            } else {
                array_push($boolean, false);
            }
        }

        if (count($boolean) == 0 | in_array(false, $boolean)) {
            return false;
        }
        return true;
    }
}

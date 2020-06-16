<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTGA extends Model
{
    protected $table = 'data_tga';

    protected $fillable = [
    	'user_id', 'category', 'type', 'name', 'display_name', 'content', 'verified'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function listData($user_id, $category = null)
    {
    	$final_data = [];

    	if ($category == null) {
    		$all_data = $this->where('user_id', $user_id)->get();
    	} else {
    		$all_data = $this->where(['user_id' => $user_id, 'category' => $category])->get();
    	}

    	foreach ($all_data as $data) {
			$final_data[str_replace('-', '_', $data->name)] = [
				'category' => $data->category,
				'type' => $data->type,
				'display_name' => $data->display_name,
				'content' => $data->content,
				'verified' => $data->verified
			];
		}

    	return json_decode(json_encode($final_data));
    }

    public function getSingleData($mhs_id, $name) {
        return $this->firstWhere(['user_id' => $mhs_id, 'name' => $name]);
    }

    public function checkSingleData($mhs_id, $name) {
        if ($this->where(['user_id' => $mhs_id, 'name' => $name])->exists()) {
            return true;
        }
        return false;
    }
}

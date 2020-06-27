<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisposisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 68; $i <= 1135; $i++) {
    		DB::table('disposisi')->insert([
    			'user_id' => $i
    		]);
    	}
        /*DB::table('disposisi')->where('user_id', 68)->update([
            'progress' => 7,
            'progress_optional' => 1,
            'no_disposisi' => '1/TA/II/2020',
            'tgl_disposisi' => '2020-06-26',
            'bypass_key' => '11912394635ef5cf8d6dd5d1789645815ef5cf8d6dd63917946635ef5cf8d6dd66',
            'updated_at' => '2020-06-26 17:35:57'
        ]);*/
    }
}

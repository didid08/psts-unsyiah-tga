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
    }
}

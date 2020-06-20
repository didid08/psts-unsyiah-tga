<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTGATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_tga')->insert([
        	'user_id' => 867,
        	'category' => 'data_administrasi_tga',
        	'type' => 'inline',
        	'name' => 'nama-pembimbingg',
        	'display_name' => 'Nama Pembimbing',
        	'content' => 'Ir. Buraida, M.M.',
            'verified' => true
        ]);

        DB::table('data_tga')->insert([
        	'user_id' => 867,
        	'category' => 'data_administrasi_tga',
        	'type' => 'inline',
        	'name' => 'nama-co-pembimbingg',
        	'display_name' => 'Nama Co Pembimbing',
        	'content' => 'Ahmad Reza Kasury, S.T., M.T.',
            'verified' => true
        ]);

		DB::table('data_tga')->insert([
        	'user_id' => 867,
        	'category' => 'data_administrasi_tga',
        	'type' => 'inline',
        	'name' => 'ketua-pengujii',
        	'display_name' => 'Ketua Penguji Seminar Proposal',
        	'content' => 'Dr. Ir. Abdullah, M.Sc.',
            'verified' => true
        ]);
    }
}

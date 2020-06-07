<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
        	'display_name' => 'Administrator'
        ]);
        DB::table('roles')->insert([
            'name' => 'koor-prodi',
        	'display_name' => 'Koordinator Prodi'
        ]);
        DB::table('roles')->insert([
            'name' => 'ketua-kel-keahlian',
        	'display_name' => 'Ketua Kelompok Keahlian'
        ]);
        DB::table('roles')->insert([
            'name' => 'pembimbing-co',
        	'display_name' => 'Pembimbing (Co)'
        ]);
        DB::table('roles')->insert([
            'name' => 'koor-tga',
        	'display_name' => 'Koordinator TGA'
        ]);
        DB::table('roles')->insert([
            'name' => 'komisi-penguji',
        	'display_name' => 'Komisi Penguji'
        ]);
        DB::table('roles')->insert([
            'name' => 'ketua-jurusan',
        	'display_name' => 'Ketua Jurusan'
        ]);
        DB::table('roles')->insert([
            'name' => 'sek-jurusan',
        	'display_name' => 'Sekretaris Jurusan'
        ]);
        DB::table('roles')->insert([
            'name' => 'mhs',
        	'display_name' => 'Mahasiswa'
        ]);
    }
}

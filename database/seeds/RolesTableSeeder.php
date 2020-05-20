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
        	'name' => 'Administrator'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Koordinator Prodi'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Ketua Kelompok Keahlian'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Pembimbing (Co)'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Koordinator TGA'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Komisi Penguji'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Ketua Jurusan'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Sekretaris Jurusan'
        ]);
        DB::table('roles')->insert([
        	'name' => 'Mahasiswa'
        ]);
    }
}

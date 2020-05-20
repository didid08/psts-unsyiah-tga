<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidang')->insert([
        	'nama' => 'Bidang Manajemen Rekayasa Konstruksi'
        ]);
        DB::table('bidang')->insert([
        	'nama' => 'Bidang Hidroteknik'
        ]);
        DB::table('bidang')->insert([
        	'nama' => 'Bidang Transportasi'
        ]);
        DB::table('bidang')->insert([
        	'nama' => 'Bidang Geoteknik'
        ]);
        DB::table('bidang')->insert([
        	'nama' => 'Bidang Struktur'
        ]);
    }
}

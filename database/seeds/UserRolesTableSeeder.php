<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Admin
        DB::table('user_roles')->insert([
        	'user_id' => 1,
        	'role_id' => 1
        ]);

        //Koordinator Prodi
		DB::table('user_roles')->insert([
        	'user_id' => 19,
        	'role_id' => 2
        ]);

		//KK Keahlian
        DB::table('user_roles')->insert([
        	'user_id' => 20,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 66,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 52,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 16,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 63,
        	'role_id' => 3
        ]);

        //Pembimbing (Co)
        for ($i = 2; $i <= 67; $i++) {
        	DB::table('user_roles')->insert([
        		'user_id' => $i,
        		'role_id' => 4
        	]);
        }

        //Koordinator TGA
        DB::table('user_roles')->insert([
        	'user_id' => 13,
        	'role_id' => 5
        ]);


        //Komisi Penguji
		for ($i = 2; $i <= 67; $i++) {
        	DB::table('user_roles')->insert([
        		'user_id' => $i,
        		'role_id' => 6
        	]);
        }

        //Ketua Jurusan
        DB::table('user_roles')->insert([
        	'user_id' => 60,
        	'role_id' => 7
        ]);

        //Sek.Jurusan
        DB::table('user_roles')->insert([
        	'user_id' => 43,
        	'role_id' => 8
        ]);

        for ($i = 68; $i <= 1068; $i++) {
        	DB::table('user_roles')->insert([
        		'user_id' => $i,
        		'role_id' => 9
        	]);
        }
    }
}

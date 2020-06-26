<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingsTableSeeder::class,
        	BidangTableSeeder::class,
        	UsersTableSeeder::class,
        	RolesTableSeeder::class,
        	UserRolesTableSeeder::class,
        	DisposisiTableSeeder::class,
            DataTableSeeder::class
        ]);
    }
}

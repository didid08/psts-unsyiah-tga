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
        	BidangTableSeeder::class,
        	UsersTableSeeder::class,
        	RolesTableSeeder::class,
        	UserRolesTableSeeder::class,
        	SettingsTableSeeder::class
        ]);
    }
}

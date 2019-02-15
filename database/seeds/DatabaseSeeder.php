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
        	SpacesTableSeeder::class,
        	PlansTableSeeder::class,
            AdminsTableSeeder::class,
            WorkshopsTableSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}

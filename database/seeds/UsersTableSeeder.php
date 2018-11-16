<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
        	'name' => 'Arthur Villar',
            'email' => 'arthurvillar@gmail.com',
        	'email_verified_at' => now(),
        	'password' => bcrypt('maiden')
        ]);
    }
}
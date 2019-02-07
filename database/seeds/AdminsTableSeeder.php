<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
        	'name' => 'Arthur Villar',
            'email' => 'arthurvillar@gmail.com',
            'role' => 'manager',
        	'password' => bcrypt('metropolis')
        ]);
    }
}
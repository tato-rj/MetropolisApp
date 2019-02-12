<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
        	'name' => 'Arthur Villar',
            'email' => 'arthur@metropolisrio.com.br',
            'role' => 'manager',
        	'password' => bcrypt('metropolis')
        ]);

        Admin::create([
        	'name' => 'Hilton Romero Jr.',
            'email' => 'hilton@metropolisrio.com.br',
            'role' => 'manager',
        	'password' => bcrypt('metropolis')
        ]);
        
        Admin::create([
        	'name' => 'Joana Araújo',
            'email' => 'joana@metropolisrio.com.br',
            'role' => 'manager',
        	'password' => bcrypt('metropolis')
        ]);
        
        Admin::create([
        	'name' => 'Marco Fernandes',
            'email' => 'marco@metropolisrio.com.br',
            'role' => 'manager',
        	'password' => bcrypt('metropolis')
        ]);
    }
}
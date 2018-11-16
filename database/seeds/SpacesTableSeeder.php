<?php

use Illuminate\Database\Seeder;
use App\Space;

class SpacesTableSeeder extends Seeder
{
    public function run()
    {
        Space::create([
        	'slug' => str_slug('workstation'),
            'type' => 'workstation',
        	'nickname' => 'Workstation',
        	'capacity' => 12,
        	'fee' => 3500,
        	'is_shared' => true
        ]);

        Space::create([
        	'slug' => str_slug('tóquio'),
            'type' => 'sala de reunião',
        	'nickname' => 'Tóquio',
        	'capacity' => 4,
        	'fee' => 4900,
        	'is_shared' => false
        ]);

        Space::create([
        	'slug' => str_slug('vale do silício'),
            'type' => 'sala de reunião',
        	'nickname' => 'Vale do Silício',
        	'capacity' => 6,
        	'fee' => 9900,
        	'is_shared' => false
        ]);
    }
}
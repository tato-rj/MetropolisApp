<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        Plan::create([
        	'type' => 'basic',
        	'name' => 'daily',
        	'fee' => 7900,
        	'benefits' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'basic',
            'name' => 'weekly',
            'fee' => 34900,
            'benefits' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'basic',
            'name' => 'monthly',
            'fee' => 109900,
            'benefits' => '8 horas mensais de Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'complete',
            'name' => 'daily',
            'fee' => 12900,
            'benefits' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'complete',
            'name' => 'weekly',
            'fee' => 41900,
            'benefits' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'complete',
            'name' => 'monthly',
            'fee' => 114900,
            'benefits' => '8 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);
    }
}
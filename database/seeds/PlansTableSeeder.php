<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        Plan::create([
        	'type' => 'basic',
            'type_pt' => 'básico',
        	'name' => 'daily',
            'name_pt' => 'diário',
            'color' => 'indigo',
        	'fee' => 7900,
            'bonus_spaces' => '2',
            'bonus_limit' => 1,
        	'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'basic',
            'type_pt' => 'básico',
            'name' => 'weekly',
            'name_pt' => 'semanal',
            'color' => 'orange',
            'fee' => 34900,
            'bonus_spaces' => '2',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'basic',
            'type_pt' => 'básico',
            'name' => 'monthly',
            'name_pt' => 'mensal',
            'color' => 'green',
            'fee' => 109900,
            'bonus_spaces' => '2',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas mensais de Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'complete',
            'type_pt' => 'completo',
            'name' => 'daily',
            'name_pt' => 'diário',
            'color' => 'blue',
            'fee' => 12900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 1,
            'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'complete',
            'type_pt' => 'completo',
            'name' => 'weekly',
            'name_pt' => 'semanal',
            'color' => 'purple',
            'fee' => 41900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'complete',
            'type_pt' => 'completo',
            'name' => 'monthly',
            'name_pt' => 'mensal',
            'color' => 'red',
            'fee' => 114900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);
    }
}
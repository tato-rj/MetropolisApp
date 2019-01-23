<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        Plan::create([
        	'type' => 'básico',
        	'name' => 'semanal',
            'code' => '3F3EA4FA-0B0B-DDEC-C45F-DFB62A2A7A2F',
            'color' => 'indigo',
        	'fee' => 34900,
            'bonus_spaces' => '2',
            'bonus_limit' => 1,
        	'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'mensal',
            'code' => '3F3EA4FA-0B0B-DDEC-C45F-DFB62A2A7A2F',
            'color' => 'orange',
            'fee' => 109900,
            'bonus_spaces' => '2',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'semestral',
            'code' => '3F3EA4FA-0B0B-DDEC-C45F-DFB62A2A7A2F',
            'color' => 'green',
            'fee' => 619900,
            'bonus_spaces' => '2',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas mensais de Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semanal',
            'code' => '3F3EA4FA-0B0B-DDEC-C45F-DFB62A2A7A2F',
            'color' => 'blue',
            'fee' => 41900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 1,
            'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'mensal',
            'code' => '3F3EA4FA-0B0B-DDEC-C45F-DFB62A2A7A2F',
            'color' => 'purple',
            'fee' => 114900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semestral',
            'code' => '3F3EA4FA-0B0B-DDEC-C45F-DFB62A2A7A2F',
            'color' => 'red',
            'fee' => 659900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);
    }
}
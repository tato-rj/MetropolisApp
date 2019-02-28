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
            'color' => 'indigo',
            'code' => '92A45CD7222296BDD4B8DF98E404563C',
        	'fee' => 34900,
            'bonus_spaces' => '2',
            'bonus_limit' => 1,
        	'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'mensal',
            'color' => 'orange',
            'code' => 'CA18EA45AEAE0DC994E27FA72F5309AD',
            'fee' => 109900,
            'bonus_spaces' => '2',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'semestral',
            'color' => 'green',
            'code' => 'D272360FA8A8AC2554715FAB6D18D0B8',
            'fee' => 619900,
            'bonus_spaces' => '2',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas mensais de Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semanal',
            'color' => 'blue',
            'code' => 'DA782875F6F6BAE664374FA542AAA86E',
            'fee' => 41900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 1,
            'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'mensal',
            'color' => 'purple',
            'code' => 'E2998607252595FDD4294F8E151B96C4',
            'fee' => 114900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semestral',
            'color' => 'red',
            'code' => 'EAA03B4B9999C7E774BF9FBD2E59734C',
            'fee' => 659900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);
    }
}
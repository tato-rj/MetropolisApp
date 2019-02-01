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
            'code' => '1D54780FB5B577E444D72F8BD67579E6',
        	'fee' => 34900,
            'bonus_spaces' => '2',
            'bonus_limit' => 1,
        	'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'mensal',
            'color' => 'orange',
            'code' => '6B19D95EFCFCFF7BB4194FB877D3D09B',
            'fee' => 109900,
            'bonus_spaces' => '2',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'semestral',
            'color' => 'green',
            'code' => '6A5641E3D7D73F22241AFF8B9465B463',
            'fee' => 619900,
            'bonus_spaces' => '2',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas mensais de Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semanal',
            'color' => 'blue',
            'code' => '8567A5CA7373485AA4BE9F8827E5CE15',
            'fee' => 41900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 1,
            'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'mensal',
            'color' => 'purple',
            'code' => 'A356FA35C9C9A5311449BFAA03148BCB',
            'fee' => 114900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semestral',
            'color' => 'red',
            'code' => 'C9B595D82525FB3BB49BBF9F2EB6B338',
            'fee' => 659900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);
    }
}
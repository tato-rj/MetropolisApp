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
            'code' => '4E83C2DD7D7D843334787F8178801895',
        	'fee' => 34900,
            'bonus_spaces' => '2',
            'bonus_limit' => 1,
        	'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'mensal',
            'color' => 'orange',
            'code' => '68AC799FFEFE46A554A6AFBC40958FCC',
            'fee' => 109900,
            'bonus_spaces' => '2',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'básico',
            'name' => 'semestral',
            'color' => 'green',
            'code' => '720020C0454525A7749B0F8501436070',
            'fee' => 619900,
            'bonus_spaces' => '2',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas mensais de Sala de Reunião Tóquio com mais 3 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semanal',
            'color' => 'blue',
            'code' => '7A421A1E4747D5300432FFBE7B2532A1',
            'fee' => 41900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 1,
            'bonus_text' => '40 minutos/dia na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'mensal',
            'color' => 'purple',
            'code' => '8280F7F2A2A2B48774C6FFAD2F9C6261',
            'fee' => 114900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 3,
            'bonus_text' => '3 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);

        Plan::create([
            'type' => 'completo',
            'name' => 'semestral',
            'color' => 'red',
            'code' => '8B0A8B130404521224263FBBB384ADAC',
            'fee' => 659900,
            'bonus_spaces' => '2,3',
            'bonus_limit' => 8,
            'bonus_text' => '8 horas semanais na Sala de Reunião Tóquio com mais 3 pessoas OU na Sala de Reunião Vale do Silício com mais 5 pessoas'
        ]);
    }
}
<?php

use Illuminate\Database\Seeder;
use App\Workshop;

class WorkshopsTableSeeder extends Seeder
{
    public function run()
    {
    	$startDate = now()->copy()->addWeeks(mt_rand(1, 16))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Gestão de Contratos'),
            'name' => 'Gestão de Contratos',
            'headline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => 80,
            'reference' => 'W-1234567890',
            'cover_image' => 'storage/workshops/demo1.jpg',
            'capacity' => 12,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 16))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Direito do Consumidor e Análise de Crédito'),
            'name' => 'Direito do Consumidor e Análise de Crédito',
            'headline' => 'Cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => 90,
            'reference' => 'W-1234567891',
            'cover_image' => 'storage/workshops/demo2.jpg',
            'capacity' => 12,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 16))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Planejamento Financeiro'),
            'name' => 'Planejamento Financeiro',
            'headline' => 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Exercitation ullamco laboris nisi ut aliquip commodo consequat.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => 75,
            'reference' => 'W-1234567892',
            'cover_image' => 'storage/workshops/demo3.jpg',
            'capacity' => 8,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 16))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Como Trabalhar com REST APIs'),
            'name' => 'Como Trabalhar com REST APIs',
            'headline' => 'Tempor incididunt ut magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco commodo consequat. In reprehenderit in voluptate velit esse cillum cupidatat non proident, sunt in culpa qui officia deserunt.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => 80,
            'reference' => 'W-1234567893',
            'cover_image' => 'storage/workshops/demo4.jpg',
            'capacity' => 16,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);
    }
}

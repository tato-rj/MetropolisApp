<?php

use Illuminate\Database\Seeder;
use App\{Workshop, WorkshopFile};

class WorkshopsTableSeeder extends Seeder
{
    public function run()
    {
        $this->deleteAllWorkshopFiles();

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Gestão de Contratos'),
            'name' => 'Gestão de Contratos',
            'headline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation <a href="#">ullamco laboris</a> nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br>In hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. Tincidunt arcu non sodales neque sodales. Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.</div>',
            'fee' => 80,
            'cover_image' => 'workshops/demo/demo1.jpg',
            'capacity' => 12,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

        // $this->createFile($workshop, ['apresentação' => 'ppt', 'contratos' => 'docx', 'exemplo de contrato' => 'pdf']);

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Direito do Consumidor e Análise de Crédito'),
            'name' => 'Direito do Consumidor e Análise de Crédito',
            'headline' => 'Cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'description' => '<div>Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. <a href="#">Tincidunt arcu non</a> sodales neque sodales.<br><br>Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor.<br><br>Diam maecenas sed enim ut sem viverra aliquet.<br><br>Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.</div>',
            'fee' => 90,
            'cover_image' => 'workshops/demo/demo2.jpg',
            'capacity' => 12,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Planejamento Financeiro'),
            'name' => 'Planejamento Financeiro',
            'headline' => 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Exercitation ullamco laboris nisi ut aliquip commodo consequat.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. Tincidunt arcu non sodales neque sodales. Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor.<br><br><a href="#">Diam maecenas</a> sed enim ut sem viverra aliquet.<br><br>Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.<br><br>Tincidunt arcu non sodales neque sodales. Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor. Diam maecenas sed enim ut sem viverra aliquet. Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.</div>',
            'fee' => null,
            'cover_image' => 'workshops/demo/demo3.jpg',
            'capacity' => 8,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

    	$startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Como Trabalhar com REST APIs'),
            'name' => 'Como Trabalhar com REST APIs',
            'headline' => 'Tempor incididunt ut magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco commodo consequat. In reprehenderit in voluptate velit esse cillum cupidatat non proident, sunt in culpa qui officia deserunt.',
            'description' => '<div>In hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. <strong>Tincidunt arcu</strong> non sodales neque sodales. Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor. Diam maecenas sed enim ut sem viverra aliquet. Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.<br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => 80,
            'cover_image' => 'workshops/demo/demo4.jpg',
            'capacity' => 16,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

        $startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Ferramentas para o Jornalismo Financeiro'),
            'name' => 'Ferramentas para o Jornalismo Financeiro',
            'headline' => 'Tempor incididunt ut magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco commodo consequat. In reprehenderit in voluptate velit esse cillum cupidatat non proident, sunt in culpa qui officia deserunt.',
            'description' => '<div>Vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. Tincidunt arcu non sodales neque sodales. <strong>Etiam non quam lacus</strong> suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor. Diam maecenas sed enim ut sem viverra aliquet. Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => null,
            'cover_image' => 'workshops/demo/demo5.jpg',
            'capacity' => 22,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

        $startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Planejamento e Gestão de Carreiras'),
            'name' => 'Planejamento e Gestão de Carreiras',
            'headline' => 'Tempor incididunt ut magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco commodo consequat. In reprehenderit in voluptate velit esse cillum cupidatat non proident, sunt in culpa qui officia deserunt.',
            'description' => '<div>Consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>In hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. Tincidunt arcu non sodales neque sodales. Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor. Diam maecenas sed enim ut sem viverra aliquet. Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>',
            'fee' => 65,
            'cover_image' => 'workshops/demo/demo6.jpg',
            'capacity' => 18,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

        $startDate = now()->copy()->addWeeks(mt_rand(1, 18))->subDays(mt_rand(1,5))->setTime(18,0,0);

        Workshop::create([
            'slug' => str_slug('Técnicas Básicas de Atendimento ao Cliente'),
            'name' => 'Técnicas Básicas de Atendimento ao Cliente',
            'headline' => 'Tempor incididunt ut magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco commodo consequat. In reprehenderit in voluptate velit esse cillum cupidatat non proident, sunt in culpa qui officia deserunt.',
            'description' => '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <strong>sed do eiusmod</strong> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br>Diam maecenas sed enim ut sem viverra aliquet. Maecenas accumsan lacus vel facilisis volutpat est velit egestas. Amet porttitor eget dolor morbi non arcu risus quis. Etiam sit amet nisl purus in mollis nunc sed id. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Nisi est sit amet facilisis magna etiam tempor.<br><br>In hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit. Tellus elementum sagittis vitae et. Varius vel pharetra vel turpis nunc eget lorem. Tincidunt arcu non sodales neque sodales. Etiam non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Nisi est sit amet facilisis magna etiam tempor.</div>',
            'fee' => 55,
            'cover_image' => 'workshops/demo/demo7.jpg',
            'capacity' => 22,
            'starts_at' => $startDate,
            'ends_at' => $startDate->copy()->addHours(mt_rand(1,2))
        ]);

        $this->createFiles();
    }

    public function createFiles()
    {
        $files = \Storage::disk('public')->files('workshops/demo/files');
        $filesCount = count($files);

        foreach (Workshop::all() as $workshop) {
            for ($i = 0; $i < mt_rand(1, $filesCount); $i++) {
                $path = $files[$i];
                $filename = basename($path);
                $name = explode('.', $filename)[0];
                $ext = explode('.', $filename)[1];

                WorkshopFile::firstOrCreate([
                    'workshop_id' => $workshop->id,
                    'path' => $path,
                    'name' => $name,
                    'extension' => $ext
                ]);
            }
        }
    }

    public function createFile($workshop, $file)
    {
        foreach ($file as $name => $extension) {
            WorkshopFile::create([
                'workshop_id' => $workshop->id,
                'path' => "workshops/demo/files/{$name}.{$extension}",
                'name' => $name,
                'extension' => $extension
            ]);            
        }
    }

    public function deleteAllWorkshopFiles()
    {
        \Storage::disk('public')->delete(
            \Storage::disk('public')->files('workshops/cover_images')
        );

        \Storage::disk('public')->delete(
            \Storage::disk('public')->files('workshops/files')
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setor;

class SetorSeeder extends Seeder
{
    public function run()
    {
        $setores = [
            'Setor 1',
            'Setor 2',
            'Setor 3',
            'Setor 4',
            'Setor 5',
            'Setor 6',
            'Setor 7'
        ];

        foreach ($setores as $setorNome) {
            Setor::create(['nome' => $setorNome]);
        }
    }
}


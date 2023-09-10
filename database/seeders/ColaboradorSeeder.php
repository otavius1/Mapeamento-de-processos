<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Colaborador;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colaboradores = [
            'Colaborador 1',
            'Colaborador 2',
            'Colaborador 3',
            'Colaborador 4',
            'Colaborador 5',
            'Colaborador 6',
            'Colaborador 7',
        ];

        foreach ($colaboradores as $colaborador) {
            Colaborador::create(['nome' => $colaborador]);
        }
    }
}


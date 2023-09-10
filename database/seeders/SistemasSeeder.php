<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sistema;

class SistemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sistemas = [
            'Sistema 1',
            'Sistema 2',
            'Sistema 3',
            'Sistema 4',
            'Sistema 5',
            'Sistema 6',
            'Sistema 7',
        ];

        foreach ($sistemas as $sistema) {
            Sistema::create(['nome' => $sistema]);
        }
    }
}
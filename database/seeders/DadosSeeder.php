<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dado;

class DadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dados = [
            'Tipo de Dado 1', 
            'Tipo de Dado 2', 
            'Tipo de Dado 3', 
            'Tipo de Dado 4', 
            'Tipo de Dado 5', 
            'Tipo de Dado 6', 
            'Tipo de Dado 7', 
        ];

        foreach ($dados as $dado) {
            Dado::create(['nome' => $dado]);
        }
    }
}
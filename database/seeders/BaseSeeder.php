<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bases = [
            'Base Legal',
            'Base Legal 2',
            'Base Legal 3',
            'Base Legal 4',
            'Base Legal 5',
            'Base Legal 6',
            'Base Legal 7',
        ];

        foreach ($bases as $base) {
            Base::create(['nome' => $base]);
        }
    }
}


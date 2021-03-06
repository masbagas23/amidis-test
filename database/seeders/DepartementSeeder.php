<?php

namespace Database\Seeders;

use App\Models\Departement;
use Database\Factories\DepartementFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Departement::factory()->count(10)->create();
    }
}

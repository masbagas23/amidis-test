<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Location;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $roles = [
            [
                'name' => 'Super Admin',
            ],
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Staff',
            ],
        ];

        Role::insert($roles);        
        Departement::factory(10)->create();
        Location::factory(10)->create();
        Product::factory(10)->create();
        User::factory(10)->create();
    }
}

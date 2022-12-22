<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles::truncate();
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'manager']);
        Roles::create(['name' => 'sale']);
        Roles::create(['name' => 'content']);
        Roles::create(['name' => 'user']);
    }
}

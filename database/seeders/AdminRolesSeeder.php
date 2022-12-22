<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AdminRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // AdminRoles::truncate();
        AdminRoles::create([
            'admin_admin_id' => '1',
            'roles_id_roles' => '1',
        ]);
        AdminRoles::create([
            'admin_admin_id' => '2',
            'roles_id_roles' => '2',
        ]);
        AdminRoles::create([
            'admin_admin_id' => '3',
            'roles_id_roles' => '3',
        ]);
    }
}

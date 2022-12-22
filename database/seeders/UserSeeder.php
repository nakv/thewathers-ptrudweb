<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::truncate();
        Admin::create(
            [
                'admin_name' => 'Anh Khoa Ad',
                'admin_email' => 'anhkhoaadmin@gmail.com',
                'admin_phone' => '0914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        Admin::create(
            [
                'admin_name' => 'Anh Khoa Manager',
                'admin_email' => 'anhkhoamanager@gmail.com',
                'admin_phone' => '1914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        Admin::create(
            [
                'admin_name' => 'Anh Khoa user',
                'admin_email' => 'anhkhoauser@gmail.com',
                'admin_phone' => '3914139767',
                'admin_password' => md5('12345678'),
            ]
        );
    }
}

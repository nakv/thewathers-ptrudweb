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
        Admin::truncate();
        $adminRoles = Roles::where('name', 'admin')->first();
        $managerRoles = Roles::where('name', 'manager')->first();
        $saleRoles = Roles::where('name', 'sale')->first();
        $contentRoles = Roles::where('name', 'content')->first();
        $userRoles = Roles::where('name', 'user')->first();
        $admin = Admin::create(
            [
                'admin_name' => 'Anh Khoa Ad',
                'admin_email' => 'anhkhoaadmin@gmail.com',
                'admin_phone' => '0914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        $manager = Admin::create(
            [
                'admin_name' => 'Anh Khoa Manager',
                'admin_email' => 'anhkhoamanager@gmail.com',
                'admin_phone' => '1914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        $sale = Admin::create(
            [
                'admin_name' => 'Anh Khoa Sale',
                'admin_email' => 'anhkhoasale@gmail.com',
                'admin_phone' => '2914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        $content = Admin::create(
            [
                'admin_name' => 'Anh Khoa content',
                'admin_email' => 'anhkhoacontent@gmail.com',
                'admin_phone' => '2914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        $user = Admin::create(
            [
                'admin_name' => 'Anh Khoa user',
                'admin_email' => 'anhkhoauser@gmail.com',
                'admin_phone' => '3914139767',
                'admin_password' => md5('12345678'),
            ]
        );
        $admin->roles()->attach($adminRoles);
        $manager->roles()->attach($managerRoles);
        $sale->roles()->attach($saleRoles);
        $content->roles()->attach($contentRoles);
        $user->roles()->attach($userRoles);
    }
}
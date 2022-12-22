<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Roles;

$factory->define(Admin::class, function (Faker $faker) {
  return [
    'admin_name' => $faker->name,
    'admin_email' => $faker->unique()->safeEmail,
    'admin_phone' => '0914139767',
    'admin_password' => '25d55ad283aa400af464c76d713c07ad', // password

  ];
});
$factory->afterCreating(Admin::class, function ($admin, $faker) {
  $roles = Roles::where('name', 'user')->get();
  $admin->roles()->sync($roles->pluck('id_roles')->toArray());
});
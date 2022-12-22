<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    use HasFactory;
    protected $table = 'admin_roles';
    protected $primaryKey = 'id_admin_roles';
    protected $fillable = [
        'admin_admin_id',
        'roles_id_roles',
    ];
}
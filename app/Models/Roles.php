<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamp = false;
    protected $fillable = [
        'name'
    ];
    protected $primayKey = 'id_roles';
    protected $table = 'tbl_roles';
    public function admin()
    {
        return $this->belongsToMany(Admin::class);
    }
}
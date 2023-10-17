<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_petugas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_petugas';
    public $incrementing = false;
    protected $fillable = [
        'nama_petugas', 'jabatan', 'departemen', 'username', 'password', 'role',
    ];
}

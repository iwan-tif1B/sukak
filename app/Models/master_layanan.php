<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_layanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_layanan';
    public $incrementing = false;
    protected $fillable = [
        'nama_layanan', 'deskripsi_layanan',
    ];
}

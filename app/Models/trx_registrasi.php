<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_registrasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_registrasi';
    public $incrementing = false;
    protected $fillable = [
        'id_pasien', 'no_registrasi','jenis_registrasi','jenis_pembayaran','status_registrasi','id_layanan','waktu_mulai_layanan','waktu_selesai_layanan','id_petugas',
    ];
}

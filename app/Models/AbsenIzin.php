<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenIzin extends Model
{
    use HasFactory;

    protected $table = 'absen_izin';
    protected $primaryKey = 'izinid';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'userid',
        'jenis_izin',
        'aktifitas',
        'tgl_dari',
        'tgl_sampai',
        'dok_ori',
        'dok_saved',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by'
    ];
}

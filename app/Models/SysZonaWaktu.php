<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysZonaWaktu extends Model
{
    use HasFactory;

    protected $table = 'sys_zona_waktu';
    protected $primaryKey = 'zona_waktu';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable =
    [
        'zona_waktu', 'keterangan', 'konversi', 'gmt',
        'remarks'
    ];
}

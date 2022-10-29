<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenSpot extends Model
{
    use HasFactory;

    protected $table = 'absen_spot';
    protected $primaryKey = 'spotid';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'spot',
        'radius',
        'alamat',
        'lat',
        'lng',
        'catatan',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by'
    ];

    public function zonaWaktu()
    {
        return $this->belongsTo(SysZonaWaktu::class, 'zona_waktu', 'zona_waktu');
    }
}

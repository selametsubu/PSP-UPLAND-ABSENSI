<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenHadir extends Model
{
    use HasFactory;

    protected $table = 'absen_hadir';
    protected $primaryKey = 'hadirid';
    public $timestamps = false;

    protected $fillable = [
        'userid',
        'tgl',
        'waktu',
        'waktu_bagian',
        'is_absen_datang',
        'is_absen_pulang',
        'status_absen',
        'status_spot',
        'lat',
        'lng',
        'lokasi',
        'prov',
        'kab',
        'kec',
        'desa',
        'catatan',
        'swafoto_thumb',
        'swafoto_ori',
        'created_at',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}

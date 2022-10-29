<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsPengelola extends Model
{
    use HasFactory;

    protected $table = 'ms_pengelola';
    protected $primaryKey = 'pengelolaid';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'nomorid',
        'peran',
        'nama',
        'nik',
        'tgl_lahir',
        'email',
        'kdkab',
        'kdkec',
        'kddesa',
        'alamat',
        'nohp',
        'posisi',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'userid',
        'jenis_kelamin',
        'roleid',
    ];
}

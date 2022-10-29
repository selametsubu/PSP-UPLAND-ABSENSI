<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsFasdes extends Model
{
    use HasFactory;
    protected $table = 'ms_fasdes';
    protected $primaryKey = 'fasdesid';
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
        'fasdesid_manajer',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'userid',
        'jenis_kelamin',
        'roleid',
    ];
}

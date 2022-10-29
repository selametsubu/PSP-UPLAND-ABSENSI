<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsPenyuluh extends Model
{
    use HasFactory;

    protected $table = 'ms_penyuluh';
    protected $primaryKey = 'penyuluhid';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'nomorid',
        'nama',
        'nik',
        'tgl_lahir',
        'email',
        'kdkab',
        'kdkec',
        'kddesa',
        'alamat',
        'nohp',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'userid',
        'jenis_kelamin',
        'roleid',
    ];
}

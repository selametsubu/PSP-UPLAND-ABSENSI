<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenHariLibur extends Model
{
    use HasFactory;

    protected $table = 'absen_harilibur';
    protected $primaryKey = 'hariliburid';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'harilibur',
        'tgl_dari',
        'tgl_sampai',
        'catatan',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by'
    ];
}

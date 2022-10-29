<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsWilDesa extends Model
{
    use HasFactory;

    protected $table = 'ms_wil_desa';
    protected $primaryKey = 'kddesa';

    protected $fillable =
    [
        'kddesa', 'kdkec', 'nmdesa', 'is_primary'
    ];
}

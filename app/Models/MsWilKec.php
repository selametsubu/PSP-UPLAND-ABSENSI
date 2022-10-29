<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsWilKec extends Model
{
    use HasFactory;

    protected $table = 'ms_wil_kec';
    protected $primaryKey = 'kdkec';

    protected $fillable =
    [
        'kdkec', 'kdkab', 'nmkec', 'is_primary'
    ];

    public function desa()
    {
        return $this->hasMany(MsWilDesa::class, 'kdkec', 'kdkec');
    }
}

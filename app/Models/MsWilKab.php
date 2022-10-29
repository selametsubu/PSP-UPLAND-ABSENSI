<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsWilKab extends Model
{
    use HasFactory;

    protected $table = 'ms_wil_kab';
    protected $primaryKey = 'kdkab';

    protected $fillable =
    [
        'kdkab', 'kdprov', 'nmkab', 'is_primary'
    ];

    public function kec()
    {
        return $this->hasMany(MsWilKec::class, 'kdkab', 'kdkab')->orderBy('kdkec');
    }
}

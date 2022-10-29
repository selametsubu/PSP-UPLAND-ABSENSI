<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysGlobalVar extends Model
{
    use HasFactory;

    protected $table = 'absen_sys_globalvar';
    protected $primaryKey = 'varname';
    public $incrementing = false;
    const UPDATED_AT = 'modified_at';

    protected $fillable =
    [
        'varname',
        'display_name',
        'vardesc',
        'val',
        'guide',
    ];
}

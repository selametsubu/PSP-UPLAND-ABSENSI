<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysRole extends Model
{
    use HasFactory;

    protected $table = 'sys_role';
    protected $primaryKey = 'roleid';

    protected $fillable =
    [
        'rolename', 'displayname', 'description',
        'kab', 'kec', 'desa', 'sortno', 'group', 'show_on_register'
    ];

}

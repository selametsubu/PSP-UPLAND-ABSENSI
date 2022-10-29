<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "sys_user";
    protected $primaryKey = 'userid';
    const UPDATED_AT = 'modified_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'nickname',
        'email',
        'password',
        'telpno',
        'photo',
        'roleid',
        'kdkab',
        'kdkec',
        'kddesa',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'nik',
        'tgl_lahir',
        'jenis_kelamin',
        'tgl_join',
        'tgl_resign',
        'alamat',
        'spotid',
        'wajib_absen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(SysRole::class, 'roleid', 'roleid');
    }

    public function spot()
    {
        return $this->belongsTo(AbsenSpot::class, 'spotid', 'spotid');
    }

    public function kab()
    {
        return $this->belongsTo(MsWilKab::class, 'kdkab', 'kdkab');
    }
    public function kec()
    {
        return $this->belongsTo(MsWilKec::class, 'kdkec', 'kdkec');
    }
    public function desa()
    {
        return $this->belongsTo(MsWilDesa::class, 'kddesa', 'kddesa');
    }
}

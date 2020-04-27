<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use Notifiable;
    protected $table = 'karyawan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_karyawan', 'alamat', 'telp' , 'email', 'username','password', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table="pelanggan";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
      'nama', 'alamat', 'telp', 'nomor_ktp'
    ];
}

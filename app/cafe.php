<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cafe extends Model
{
    protected $table="cafe";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
      'nama_cafe', 'alamat', 'harga', 'gambar', 'sedia'
    ];
}

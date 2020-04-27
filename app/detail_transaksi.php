<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    protected $table="detail_transaksi";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
      'id_transaksi', 'id_cafe', 'subtotal'
    ];
}

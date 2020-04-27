<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table="transaksi";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
      'id_pelanggan', 'tgl_transaksi', 'check_in', 'check_out', 'nomor_meja'
    ];
}

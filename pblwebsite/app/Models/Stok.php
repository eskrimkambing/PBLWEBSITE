<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $primaryKey = 'id_stok';
    protected $fillable = ['id_produk', 'tanggal_stok', 'jumlah_stok', 'status_stok'];
    public function produk() { return $this->belongsTo(Produk::class, 'id_produk'); }

}

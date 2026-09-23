<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $primaryKey = 'id_detail';
    protected $fillable = ['id_pesanan','id_produk','id_promo','jumlah_beli','subtotal_harga'];
    public function pesanan() { return $this->belongsTo(Pesanan::class, 'id_pesanan'); }
    public function produk() { return $this->belongsTo(Produk::class, 'id_produk'); }
    public function promo() { return $this->belongsTo(Promo::class, 'id_promo'); }

}

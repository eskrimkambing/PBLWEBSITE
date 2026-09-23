<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $primaryKey = 'id_produk';
    protected $fillable = ['id_kategori', 'id_penjual', 'nama_produk', 'deskripsi', 'harga_satuan', 'stok_tersedia'];
    public function kategori() { return $this->belongsTo(Kategori::class, 'id_kategori'); }
    public function penjual() { return $this->belongsTo(Penjual::class, 'id_penjual'); }
    public function stoks() { return $this->hasMany(Stok::class, 'id_produk'); }

}

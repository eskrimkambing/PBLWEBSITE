<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $primaryKey = 'id_pesanan';
    protected $fillable = ['id_pembeli','tanggal_pesanan','alamat_pengiriman','no_telpon','nama_pembeli','total_tagihan','status_pesanan','catatan'];
    public function pembeli() { return $this->belongsTo(Pembeli::class, 'id_pembeli'); }
    public function detailPesanans() { return $this->hasMany(DetailPesanan::class, 'id_pesanan'); }
    public function transaksis() { return $this->hasMany(Transaksi::class, 'id_pesanan'); }

}

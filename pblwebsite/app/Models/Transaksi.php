<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
protected $primaryKey = 'id_transaksi';
protected $fillable = ['id_pesanan','tanggal_bayar','bukti_bayar','metode_pembayaran','status_validasi'];
public function pesanan() { return $this->belongsTo(Pesanan::class, 'id_pesanan'); }

}

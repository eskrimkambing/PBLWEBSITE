<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $primaryKey = 'id_penjual';
    protected $fillable = ['nama', 'email', 'password'];
    public function produks() { return $this->hasMany(Produk::class, 'id_penjual'); }

}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PromoController;


Route::get('/', function () {
    return redirect()->route('produk.index');
});

Route::resource('kategori', KategoriController::class);
Route::resource('produk', ProdukController::class);
Route::resource('pembeli', PembeliController::class);
Route::resource('penjual', PenjualController::class);
Route::resource('pesanan', PesananController::class);
Route::resource('detail-pesanan', DetailPesananController::class);
Route::resource('stok', StokController::class);
Route::resource('transaksi', TransaksiController::class);
Route::resource('promo', PromoController::class);
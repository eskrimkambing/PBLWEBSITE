<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Promo;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    public function index()
    {
        $detailPesanans = DetailPesanan::with(['pesanan', 'produk', 'promo'])->latest()->paginate(10);
        return view('detail-pesanan.index', compact('detailPesanans'));
    }

    public function create()
    {
        $pesanans = Pesanan::all();
        $produks = Produk::all();
        $promos = Promo::all();
        return view('detail-pesanan.create', compact('pesanans', 'produks', 'promos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pesanan'     => 'required|exists:pesanans,id_pesanan',
            'id_produk'      => 'required|exists:produks,id_produk',
            'id_promo'       => 'nullable|exists:promos,id_promo',
            'jumlah_beli'    => 'required|integer|min:1',
            'subtotal_harga' => 'required|numeric|min:0',
        ]);

        DetailPesanan::create($data);

        return redirect()->route('detail-pesanan.index')
            ->with('success', 'Detail pesanan berhasil ditambahkan.');
    }

    public function show(DetailPesanan $detailPesanan)
    {
        return view('detail-pesanan.show', compact('detailPesanan'));
    }

    public function edit(DetailPesanan $detailPesanan)
    {
        $pesanans = Pesanan::all();
        $produks = Produk::all();
        $promos = Promo::all();
        return view('detail-pesanan.edit', compact('detailPesanan', 'pesanans', 'produks', 'promos'));
    }

    public function update(Request $request, DetailPesanan $detailPesanan)
    {
        $data = $request->validate([
            'id_pesanan'     => 'required|exists:pesanans,id_pesanan',
            'id_produk'      => 'required|exists:produks,id_produk',
            'id_promo'       => 'nullable|exists:promos,id_promo',
            'jumlah_beli'    => 'required|integer|min:1',
            'subtotal_harga' => 'required|numeric|min:0',
        ]);

        $detailPesanan->update($data);

        return redirect()->route('detail-pesanan.index')
            ->with('success', 'Detail pesanan berhasil diperbarui.');
    }

    public function destroy(DetailPesanan $detailPesanan)
    {
        $detailPesanan->delete();

        return redirect()->route('detail-pesanan.index')
            ->with('success', 'Detail pesanan berhasil dihapus.');
    }
}
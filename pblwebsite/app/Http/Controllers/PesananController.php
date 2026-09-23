<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('pembeli')->latest()->paginate(10);
        return view('pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $pembelis = Pembeli::all();
        return view('pesanan.create', compact('pembelis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pembeli'         => 'required|exists:pembelis,id_pembeli',
            'tanggal_pesanan'    => 'required|date',
            'nama_pembeli'       => 'required|string|max:100',
            'no_telpon'          => 'required|string|max:20',
            'alamat_pengiriman'  => 'required|string',
            'total_tagihan'      => 'required|numeric|min:0',
            'status_pesanan'     => 'required|in:menunggu,diproses,dikirim,selesai,dibatalkan',
            'catatan'            => 'nullable|string',
        ]);

        Pesanan::create($data);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['pembeli', 'detailPesanans.produk']);
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        $pembelis = Pembeli::all();
        return view('pesanan.edit', compact('pesanan', 'pembelis'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $data = $request->validate([
            'id_pembeli'         => 'required|exists:pembelis,id_pembeli',
            'tanggal_pesanan'    => 'required|date',
            'nama_pembeli'       => 'required|string|max:100',
            'no_telpon'          => 'required|string|max:20',
            'alamat_pengiriman'  => 'required|string',
            'total_tagihan'      => 'required|numeric|min:0',
            'status_pesanan'     => 'required|in:menunggu,diproses,dikirim,selesai,dibatalkan',
            'catatan'            => 'nullable|string',
        ]);

        $pesanan->update($data);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
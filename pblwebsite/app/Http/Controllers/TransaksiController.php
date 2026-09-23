<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pesanan')->latest()->paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pesanans = Pesanan::all();
        return view('transaksi.create', compact('pesanans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pesanan'        => 'required|exists:pesanans,id_pesanan',
            'tanggal_bayar'     => 'required|date',
            'bukti_bayar'       => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|in:transfer_bank,e_wallet,cod',
            'status_validasi'   => 'required|in:pending,valid,ditolak',
        ]);

        Transaksi::create($data);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $pesanans = Pesanan::all();
        return view('transaksi.edit', compact('transaksi', 'pesanans'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'id_pesanan'        => 'required|exists:pesanans,id_pesanan',
            'tanggal_bayar'     => 'required|date',
            'bukti_bayar'       => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|in:transfer_bank,e_wallet,cod',
            'status_validasi'   => 'required|in:pending,valid,ditolak',
        ]);

        $transaksi->update($data);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
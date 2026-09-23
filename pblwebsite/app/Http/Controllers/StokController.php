<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stoks = Stok::with('produk')->latest()->paginate(10);
        return view('stok.index', compact('stoks'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('stok.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_produk'    => 'required|exists:produks,id_produk',
            'tanggal_stok' => 'required|date',
            'jumlah_stok'  => 'required|integer|min:1',
            'status_stok'  => 'required|in:masuk,keluar',
        ]);

        Stok::create($data);

        return redirect()->route('stok.index')
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    public function show(Stok $stok)
    {
        return view('stok.show', compact('stok'));
    }

    public function edit(Stok $stok)
    {
        $produks = Produk::all();
        return view('stok.edit', compact('stok', 'produks'));
    }

    public function update(Request $request, Stok $stok)
    {
        $data = $request->validate([
            'id_produk'    => 'required|exists:produks,id_produk',
            'tanggal_stok' => 'required|date',
            'jumlah_stok'  => 'required|integer|min:1',
            'status_stok'  => 'required|in:masuk,keluar',
        ]);

        $stok->update($data);

        return redirect()->route('stok.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(Stok $stok)
    {
        $stok->delete();

        return redirect()->route('stok.index')
            ->with('success', 'Stok berhasil dihapus.');
    }
}
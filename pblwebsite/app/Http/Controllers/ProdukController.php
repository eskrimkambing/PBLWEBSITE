<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Penjual;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with(['kategori', 'penjual'])->latest()->paginate(10);
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $penjuals = Penjual::all();
        return view('produk.create', compact('kategoris', 'penjuals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategori'   => 'required|exists:kategoris,id_kategori',
            'id_penjual'    => 'required|exists:penjuals,id_penjual',
            'nama_produk'   => 'required|string|max:150',
            'deskripsi'     => 'nullable|string',
            'harga_satuan'  => 'required|numeric|min:0',
            'stok_tersedia' => 'required|integer|min:0',
        ]);

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        $penjuals = Penjual::all();
        return view('produk.edit', compact('produk', 'kategoris', 'penjuals'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'id_kategori'   => 'required|exists:kategoris,id_kategori',
            'id_penjual'    => 'required|exists:penjuals,id_penjual',
            'nama_produk'   => 'required|string|max:150',
            'deskripsi'     => 'nullable|string',
            'harga_satuan'  => 'required|numeric|min:0',
            'stok_tersedia' => 'required|integer|min:0',
        ]);

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
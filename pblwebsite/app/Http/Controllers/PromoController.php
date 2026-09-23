<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('promo.index', compact('promos'));
    }

    public function create()
    {
        return view('promo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_promo'     => 'required|string|max:50',
            'nilai_diskon'    => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date',
        ]);

        Promo::create($data);

        return redirect()->route('promo.index')
            ->with('success', 'Promo berhasil ditambahkan.');
    }

    public function show(Promo $promo)
    {
        return view('promo.show', compact('promo'));
    }

    public function edit(Promo $promo)
    {
        return view('promo.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            'jenis_promo'     => 'required|string|max:50',
            'nilai_diskon'    => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date',
        ]);

        $promo->update($data);

        return redirect()->route('promo.index')
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('promo.index')
            ->with('success', 'Promo berhasil dihapus.');
    }
}
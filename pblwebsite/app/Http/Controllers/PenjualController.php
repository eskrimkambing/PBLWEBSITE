<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenjualController extends Controller
{
    public function index()
    {
        $penjuals = Penjual::latest()->paginate(10);
        return view('penjual.index', compact('penjuals'));
    }

    public function create()
    {
        return view('penjual.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:penjuals,email',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        Penjual::create($data);

        return redirect()->route('penjual.index')
            ->with('success', 'Penjual berhasil ditambahkan.');
    }

    public function show(Penjual $penjual)
    {
        return view('penjual.show', compact('penjual'));
    }

    public function edit(Penjual $penjual)
    {
        return view('penjual.edit', compact('penjual'));
    }

    public function update(Request $request, Penjual $penjual)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:penjuals,email,' . $penjual->id_penjual . ',id_penjual',
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $penjual->update($data);

        return redirect()->route('penjual.index')
            ->with('success', 'Penjual berhasil diperbarui.');
    }

    public function destroy(Penjual $penjual)
    {
        $penjual->delete();

        return redirect()->route('penjual.index')
            ->with('success', 'Penjual berhasil dihapus.');
    }
}
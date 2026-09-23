<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    public function index()
    {
        $pembelis = Pembeli::latest()->paginate(10);
        return view('pembeli.index', compact('pembelis'));
    }

    public function create()
    {
        return view('pembeli.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:100',
            'email'     => 'required|email|max:150|unique:pembelis,email',
            'password'  => 'required|string|min:6',
            'alamat'    => 'required|string',
            'no_telpon' => 'required|string|max:20',
        ]);

        $data['password'] = Hash::make($data['password']);

        Pembeli::create($data);

        return redirect()->route('pembeli.index')
            ->with('success', 'Pembeli berhasil ditambahkan.');
    }

    public function show(Pembeli $pembeli)
    {
        return view('pembeli.show', compact('pembeli'));
    }

    public function edit(Pembeli $pembeli)
    {
        return view('pembeli.edit', compact('pembeli'));
    }

    public function update(Request $request, Pembeli $pembeli)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:100',
            'email'     => 'required|email|max:150|unique:pembelis,email,' . $pembeli->id_pembeli . ',id_pembeli',
            'password'  => 'nullable|string|min:6',
            'alamat'    => 'required|string',
            'no_telpon' => 'required|string|max:20',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $pembeli->update($data);

        return redirect()->route('pembeli.index')
            ->with('success', 'Pembeli berhasil diperbarui.');
    }

    public function destroy(Pembeli $pembeli)
    {
        $pembeli->delete();

        return redirect()->route('pembeli.index')
            ->with('success', 'Pembeli berhasil dihapus.');
    }
}

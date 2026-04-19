<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::all();
        return view('admin.mejas.index', compact('mejas'));
    }

    public function create()
    {
        return view('admin.mejas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_meja' => 'required|string|max:255',
            'kapasitas' => 'required|numeric|min:1',
            'status' => 'required|string|in:tersedia,tidak tersedia',
        ]);

        Meja::create($request->all());

        return back()->with('success', 'Meja berhasil ditambahkan.');
    }

    public function edit(Meja $meja)
    {
        return response()->json($meja);
    }

    public function update(Request $request, Meja $meja)
    {
        $request->validate([
            'nama_meja' => 'required|string|max:255',
            'kapasitas' => 'required|numeric|min:1',
            'status' => 'required|string|in:tersedia,tidak tersedia',
        ]);

        $meja->update($request->all());

        return back()->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();
        return back()->with('success', 'Meja berhasil dihapus.');
    }
}

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
        // CRUD logic would go here
    }

    public function edit(Meja $meja)
    {
        return view('admin.mejas.edit', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        // Update logic would go here
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();
        return back()->with('success', 'Table deleted successfully.');
    }
}

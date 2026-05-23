<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Services\MejaService;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    protected $mejaService;

    public function __construct(MejaService $mejaService)
    {
        $this->mejaService = $mejaService;
    }

    public function index()
    {
        $mejas = $this->mejaService->getAllMejas();
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

        $this->mejaService->storeMeja($request->all());

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

        $this->mejaService->updateMeja($meja, $request->all());

        return back()->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Meja $meja)
    {
        $this->mejaService->deleteMeja($meja);
        return back()->with('success', 'Meja berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Meja;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'meja_id' => 'required|exists:mejas,id',
            'durasi' => 'required|numeric|min:1',
        ]);

        $reservasi = Reservasi::create([
            'user_id' => auth()->id(),
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'meja_id' => $request->meja_id,
            'durasi' => $request->durasi,
            'status' => 'pending',
        ]);

        // Create initial payment (DP 30%)
        // For simplicity, we assume some logic to calculate DP
        Pembayaran::create([
            'reservasi_id' => $reservasi->id,
            'jumlah_dp' => 50000, // Fixed DP for now
            'status' => 'pending',
        ]);

        return back()->with('success', 'Reservasi berhasil dibuat. Silakan lakukan pembayaran DP.');
    }

    public function history()
    {
        $reservasis = auth()->user()->reservasis()->with('meja')->latest()->get();
        return view('dashboard', compact('reservasis'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Services\ReservasiService;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    protected $reservasiService;

    public function __construct(ReservasiService $reservasiService)
    {
        $this->reservasiService = $reservasiService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'meja_id' => 'required|exists:mejas,id',
            'durasi' => 'required|numeric|min:1',
            'whatsapp' => 'required|string|max:20',
            'cart_data' => 'required|string',
        ]);

        $cart = json_decode($request->cart_data, true);
        if (empty($cart)) {
            return back()->withErrors(['cart_data' => 'Keranjang pesanan tidak boleh kosong.']);
        }

        try {
            $this->reservasiService->createReservasi($request->all(), $cart);
            return redirect()->route('dashboard')->with('success', 'Reservasi dan pesanan berhasil dibuat! Silakan bayar DP sebesar 50% dari total.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['meja_id' => $e->getMessage()]);
        }
    }

    public function history()
    {
        $reservasis = $this->reservasiService->getUserHistory(auth()->user());
        return view('dashboard', compact('reservasis'));
    }
}

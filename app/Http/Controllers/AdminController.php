<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\User;
use App\Models\Pembayaran;
use App\Services\ReservasiService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $reservasiService;

    public function __construct(ReservasiService $reservasiService)
    {
        $this->reservasiService = $reservasiService;
    }

    public function index()
    {
        $total_pemasukan = Pembayaran::where('status', 'valid')
            ->selectRaw('SUM(total_bayar - sisa_bayar) as total')
            ->first()->total ?? 0;
        $total_reservasi = Reservasi::count();
        $total_pelanggan = User::where('role', 'user')->count();
        $recent_reservasis = Reservasi::with(['user', 'meja'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('total_pemasukan', 'total_reservasi', 'total_pelanggan', 'recent_reservasis'));
    }

    public function reservasis()
    {
        $reservasis = $this->reservasiService->getAllReservasis();
        return view('admin.reservasis', compact('reservasis'));
    }

    public function verifyPayment(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'status' => 'required|in:valid,ditolak'
        ]);

        $this->reservasiService->updatePaymentStatus($reservasi, $request->status);

        return back()->with('success', 'Status pembayaran diperbarui.');
    }

    public function lunasPayment(Reservasi $reservasi)
    {
        try {
            $this->reservasiService->pelunasan($reservasi);
            return back()->with('success', 'Pembayaran telah dilunaskan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

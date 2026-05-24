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

        // Data untuk chart (6 bulan terakhir)
        $chart_labels = [];
        $chart_data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chart_labels[] = $month->translatedFormat('M');
            
            $income = Pembayaran::where('status', 'valid')
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->selectRaw('SUM(total_bayar - sisa_bayar) as total')
                ->first()->total ?? 0;
            $chart_data[] = $income;
        }

        return view('admin.dashboard', compact(
            'total_pemasukan', 
            'total_reservasi', 
            'total_pelanggan', 
            'recent_reservasis',
            'chart_labels',
            'chart_data'
        ));
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

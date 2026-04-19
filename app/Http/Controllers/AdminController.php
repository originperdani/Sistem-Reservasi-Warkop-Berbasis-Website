<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\User;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
        $reservasis = Reservasi::with(['user', 'meja', 'pembayaran', 'detailPesanans.menu'])->latest()->get();
        return view('admin.reservasis', compact('reservasis'));
    }

    public function verifyPayment(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'status' => 'required|in:valid,ditolak'
        ]);

        $reservasi->pembayaran->update(['status' => $request->status]);
        $reservasi->update(['status' => $request->status]);

        return back()->with('success', 'Status pembayaran diperbarui.');
    }

    public function lunasPayment(Reservasi $reservasi)
    {
        if (!$reservasi->pembayaran) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $reservasi->pembayaran->update([
            'sisa_bayar' => 0,
            'status' => 'valid'
        ]);

        return back()->with('success', 'Pembayaran telah dilunaskan.');
    }
}

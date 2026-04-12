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
        $total_pemasukan = Pembayaran::where('status', 'valid')->sum('jumlah_dp');
        $total_reservasi = Reservasi::count();
        $total_pelanggan = User::where('role', 'user')->count();
        $recent_reservasis = Reservasi::with(['user', 'meja'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('total_pemasukan', 'total_reservasi', 'total_pelanggan', 'recent_reservasis'));
    }

    public function reservasis()
    {
        $reservasis = Reservasi::with(['user', 'meja', 'pembayaran'])->latest()->get();
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
}

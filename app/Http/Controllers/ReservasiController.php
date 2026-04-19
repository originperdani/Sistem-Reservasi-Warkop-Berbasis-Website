<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Meja;
use App\Models\Pembayaran;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
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

        // Validasi Overlapping (Cek apakah meja sudah dipesan di waktu tersebut)
        $requestStartTime = \Carbon\Carbon::parse($request->tanggal . ' ' . $request->waktu);
        $requestEndTime = $requestStartTime->copy()->addHours((int)$request->durasi);

        $isOverlapping = Reservasi::where('meja_id', $request->meja_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'valid')
            ->get()
            ->filter(function($existing) use ($requestStartTime, $requestEndTime) {
                $existingStart = \Carbon\Carbon::parse($existing->tanggal->format('Y-m-d') . ' ' . $existing->waktu);
                $existingEnd = $existingStart->copy()->addHours((int)$existing->durasi);
                
                return ($requestStartTime->between($existingStart, $existingEnd, false) || 
                        $requestEndTime->between($existingStart, $existingEnd, false) ||
                        ($requestStartTime->lessThanOrEqualTo($existingStart) && $requestEndTime->greaterThanOrEqualTo($existingEnd)));
            })->isNotEmpty();

        if ($isOverlapping) {
            return back()->withInput()->withErrors(['meja_id' => 'Maaf, meja ini sudah dipesan pada jam tersebut. Silakan pilih waktu atau meja lain.']);
        }

        return DB::transaction(function() use ($request, $cart) {
            $reservasi = Reservasi::create([
                'user_id' => auth()->id(),
                'whatsapp' => $request->whatsapp,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'meja_id' => $request->meja_id,
                'durasi' => $request->durasi,
                'status' => 'pending',
            ]);

            // Simpan Detail Pesanan
            $totalHarga = 0;
            foreach ($cart as $item) {
                DetailPesanan::create([
                    'reservasi_id' => $reservasi->id,
                    'menu_id' => $item['id'],
                    'jumlah' => $item['quantity'],
                ]);
                $totalHarga += $item['price'] * $item['quantity'];
            }

            $jumlahDP = $totalHarga * 0.5; // DP 50%
            $sisaBayar = $totalHarga - $jumlahDP;

            // Create initial payment (DP 50%)
            Pembayaran::create([
                'reservasi_id' => $reservasi->id,
                'total_bayar' => $totalHarga,
                'jumlah_dp' => $jumlahDP,
                'sisa_bayar' => $sisaBayar,
                'status' => 'pending',
            ]);

            return redirect()->route('dashboard')->with('success', 'Reservasi dan pesanan berhasil dibuat! Silakan bayar DP sebesar Rp ' . number_format($jumlahDP, 0, ',', '.') . ' (50% dari total).');
        });
    }

    public function history()
    {
        $reservasis = auth()->user()->reservasis()->with('meja')->latest()->get();
        return view('dashboard', compact('reservasis'));
    }
}

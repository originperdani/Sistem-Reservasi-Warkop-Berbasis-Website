<?php

namespace App\Services;

use App\Models\Reservasi;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservasiService
{
    public function getUserHistory($user)
    {
        return $user->reservasis()->with(['meja', 'pembayaran', 'detailPesanans.menu'])->latest()->get();
    }

    public function createReservasi(array $data, array $cart)
    {
        if ($this->isOverlapping($data['meja_id'], $data['tanggal'], $data['waktu'], $data['durasi'])) {
            throw new \Exception('Maaf, meja ini sudah dipesan pada jam tersebut. Silakan pilih waktu atau meja lain.');
        }

        return DB::transaction(function() use ($data, $cart) {
            $reservasi = Reservasi::create([
                'user_id' => auth()->id(),
                'whatsapp' => $data['whatsapp'],
                'tanggal' => $data['tanggal'],
                'waktu' => $data['waktu'],
                'meja_id' => $data['meja_id'],
                'durasi' => $data['durasi'],
                'status' => 'pending',
            ]);

            $totalHarga = 0;
            foreach ($cart as $item) {
                $menu = \App\Models\Menu::find($item['id']);
                DetailPesanan::create([
                    'reservasi_id' => $reservasi->id,
                    'menu_id' => $item['id'],
                    'jumlah' => $item['quantity'],
                ]);
                $totalHarga += $menu->harga * $item['quantity'];
            }

            $jumlahDP = $totalHarga * 0.5;
            $sisaBayar = $totalHarga - $jumlahDP;

            Pembayaran::create([
                'reservasi_id' => $reservasi->id,
                'total_bayar' => $totalHarga,
                'jumlah_dp' => $jumlahDP,
                'sisa_bayar' => $sisaBayar,
                'status' => 'pending',
            ]);

            return $reservasi;
        });
    }

    public function isOverlapping($mejaId, $tanggal, $waktu, $durasi)
    {
        $requestStartTime = Carbon::parse($tanggal . ' ' . $waktu);
        $requestEndTime = $requestStartTime->copy()->addHours((int)$durasi);

        // Optimasi: Gunakan database query untuk filtering awal sebelum koleksi
        // Index idx_reservasi_overlap akan sangat membantu di sini
        return Reservasi::where('meja_id', $mejaId)
            ->where('tanggal', $tanggal)
            ->where('status', 'valid')
            ->get()
            ->filter(function($existing) use ($requestStartTime, $requestEndTime) {
                $existingStart = Carbon::parse($existing->tanggal->format('Y-m-d') . ' ' . $existing->waktu);
                $existingEnd = $existingStart->copy()->addHours((int)$existing->durasi);
                
                return ($requestStartTime->between($existingStart, $existingEnd, false) || 
                        $requestEndTime->between($existingStart, $existingEnd, false) ||
                        ($requestStartTime->lessThanOrEqualTo($existingStart) && $requestEndTime->greaterThanOrEqualTo($existingEnd)));
            })->isNotEmpty();
    }

    public function getAllReservasis()
    {
        return Reservasi::with(['user', 'meja', 'pembayaran', 'detailPesanans.menu'])->latest()->get();
    }

    public function updatePaymentStatus(Reservasi $reservasi, $status)
    {
        $reservasi->pembayaran->update(['status' => $status]);
        $reservasi->update(['status' => $status]);
        return $reservasi;
    }

    public function pelunasan(Reservasi $reservasi)
    {
        if (!$reservasi->pembayaran) {
            throw new \Exception('Data pembayaran tidak ditemukan.');
        }

        $reservasi->pembayaran->update([
            'sisa_bayar' => 0,
            'status' => 'valid'
        ]);

        return $reservasi;
    }
}

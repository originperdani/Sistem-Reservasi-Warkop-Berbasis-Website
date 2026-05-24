<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $query = Reservasi::with(['user', 'meja', 'pembayaran'])
            ->whereYear('tanggal', $tahun);

        if ($bulan != 'all') {
            $query->whereMonth('tanggal', $bulan);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();

        $total_pendapatan = $laporan->where('status', 'valid')->sum(function($item) {
            return $item->pembayaran ? $item->pembayaran->total_bayar : 0;
        });

        return view('admin.laporan.index', compact('laporan', 'bulan', 'tahun', 'total_pendapatan'));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $query = Reservasi::with(['user', 'meja', 'pembayaran'])
            ->whereYear('tanggal', $tahun);

        if ($bulan != 'all') {
            $query->whereMonth('tanggal', $bulan);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();
        $total_pendapatan = $laporan->where('status', 'valid')->sum(function($item) {
            return $item->pembayaran ? $item->pembayaran->total_bayar : 0;
        });

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan', 'bulan', 'tahun', 'total_pendapatan'));
        return $pdf->download('Laporan-Reservasi-'.$bulan.'-'.$tahun.'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $query = Reservasi::with(['user', 'meja', 'pembayaran'])
            ->whereYear('tanggal', $tahun);

        if ($bulan != 'all') {
            $query->whereMonth('tanggal', $bulan);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();

        $filename = 'Laporan-Reservasi-'.$bulan.'-'.$tahun.'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function() use ($laporan) {
            $file = fopen('php://output', 'w');
            
            // BOM for Excel UTF-8 compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($file, [
                'No',
                'Nama Pelanggan',
                'Meja',
                'Tanggal',
                'Waktu',
                'Durasi (Jam)',
                'Status',
                'Total Bayar',
                'DP',
                'Sisa Bayar',
            ], ';');

            // Data rows
            foreach ($laporan as $index => $res) {
                fputcsv($file, [
                    $index + 1,
                    $res->user->name,
                    $res->meja->nama_meja,
                    $res->tanggal->format('d/m/Y'),
                    $res->waktu,
                    $res->durasi,
                    ucfirst($res->status),
                    $res->pembayaran ? $res->pembayaran->total_bayar : 0,
                    $res->pembayaran ? $res->pembayaran->jumlah_dp : 0,
                    $res->pembayaran ? $res->pembayaran->sisa_bayar : 0,
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}


<?php

namespace App\Exports;

use App\Models\Reservasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Reservasi::with(['user', 'meja', 'pembayaran'])
            ->whereYear('tanggal', $this->tahun);

        if ($this->bulan != 'all') {
            $query->whereMonth('tanggal', $this->bulan);
        }

        return $query->orderBy('tanggal', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID Reservasi',
            'Nama Pelanggan',
            'Meja',
            'Tanggal',
            'Waktu',
            'Status',
            'Total Bayar',
        ];
    }

    public function map($reservasi): array
    {
        return [
            $reservasi->id,
            $reservasi->user->name,
            $reservasi->meja->nama_meja,
            $reservasi->tanggal->format('d/m/Y'),
            $reservasi->waktu,
            $reservasi->status,
            $reservasi->pembayaran ? $reservasi->pembayaran->total_bayar : 0,
        ];
    }
}

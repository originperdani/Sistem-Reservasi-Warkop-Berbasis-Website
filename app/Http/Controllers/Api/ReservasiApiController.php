<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Services\ReservasiService;
use Illuminate\Http\Request;

class ReservasiApiController extends Controller
{
    protected $reservasiService;

    public function __construct(ReservasiService $reservasiService)
    {
        $this->reservasiService = $reservasiService;
    }

    public function index(Request $request)
    {
        $reservasis = $this->reservasiService->getUserHistory($request->user());
        return response()->json([
            'status' => 'success',
            'data' => $reservasis->load(['pembayaran', 'detailPesanans.menu'])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'meja_id' => 'required|exists:mejas,id',
            'durasi' => 'required|numeric|min:1',
            'whatsapp' => 'required|string|max:20',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $reservasi = $this->reservasiService->createReservasi($request->all(), $request->items);
            return response()->json([
                'status' => 'success',
                'message' => 'Reservasi berhasil dibuat',
                'data' => $reservasi->load(['pembayaran', 'detailPesanans.menu'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }
}

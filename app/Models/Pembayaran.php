<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['reservasi_id', 'total_bayar', 'jumlah_dp', 'sisa_bayar', 'bukti', 'status'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}

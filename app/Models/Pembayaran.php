<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['reservasi_id', 'jumlah_dp', 'bukti', 'status'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}

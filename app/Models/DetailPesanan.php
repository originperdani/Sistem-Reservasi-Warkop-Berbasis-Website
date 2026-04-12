<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $fillable = ['reservasi_id', 'menu_id', 'jumlah'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}

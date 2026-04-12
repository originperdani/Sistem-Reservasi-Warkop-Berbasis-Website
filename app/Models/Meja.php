<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $fillable = ['nama_meja', 'kapasitas', 'status'];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}

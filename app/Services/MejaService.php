<?php

namespace App\Services;

use App\Models\Meja;
use Illuminate\Support\Facades\Cache;

class MejaService
{
    protected $cacheKey = 'mejas_all';

    public function getAllMejas()
    {
        return Cache::remember($this->cacheKey, 3600, function () {
            return Meja::all();
        });
    }

    public function storeMeja(array $data)
    {
        $meja = Meja::create($data);
        $this->clearCache();
        return $meja;
    }

    public function updateMeja(Meja $meja, array $data)
    {
        $meja->update($data);
        $this->clearCache();
        return $meja;
    }

    public function deleteMeja(Meja $meja)
    {
        $meja->delete();
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::forget($this->cacheKey);
    }
}

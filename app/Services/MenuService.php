<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class MenuService
{
    protected $cacheKey = 'menus_all';

    public function getAllMenus()
    {
        return Cache::remember($this->cacheKey, 3600, function () {
            return Menu::all();
        });
    }

    public function storeMenu(array $data, $image = null)
    {
        if ($image) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/menu'), $imageName);
            $data['gambar'] = '/images/menu/' . $imageName;
        }

        $menu = Menu::create($data);
        $this->clearCache();
        return $menu;
    }

    public function updateMenu(Menu $menu, array $data, $image = null)
    {
        if ($image) {
            $this->deleteImage($menu->gambar);
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/menu'), $imageName);
            $data['gambar'] = '/images/menu/' . $imageName;
        }

        $menu->update($data);
        $this->clearCache();
        return $menu;
    }

    public function deleteMenu(Menu $menu)
    {
        $this->deleteImage($menu->gambar);
        $menu->delete();
        $this->clearCache();
    }

    protected function deleteImage($path)
    {
        if ($path && File::exists(public_path($path)) && !str_contains($path, 'http')) {
            File::delete(public_path($path));
        }
    }

    protected function clearCache()
    {
        Cache::forget($this->cacheKey);
    }
}

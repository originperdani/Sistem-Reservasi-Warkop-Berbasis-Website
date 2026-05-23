<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Services\MejaService;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected $menuService;
    protected $mejaService;

    public function __construct(MenuService $menuService, MejaService $mejaService)
    {
        $this->menuService = $menuService;
        $this->mejaService = $mejaService;
    }

    public function getMenus()
    {
        $menus = $this->menuService->getAllMenus();
        return response()->json([
            'status' => 'success',
            'data' => $menus
        ]);
    }

    public function getMejas()
    {
        $mejas = $this->mejaService->getAllMejas();
        return response()->json([
            'status' => 'success',
            'data' => $mejas
        ]);
    }
}

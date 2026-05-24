<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'menus' => \App\Models\Menu::take(4)->get() // Limit to 4 for Best Seller
    ]);
})->name('home');

Route::get('/menu', function () {
    return view('menu', [
        'menus' => \App\Models\Menu::all()
    ]);
})->name('menu.index');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/panduan-pemesanan', function () {
    return view('panduan');
})->name('panduan');


Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // User Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/history', [ReservasiController::class, 'history'])->name('reservasi.history');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('menus', MenuController::class);
        Route::resource('mejas', MejaController::class);
        Route::get('/reservasis', [AdminController::class, 'reservasis'])->name('admin.reservasis');
        Route::post('/reservasis/{reservasi}/verify', [AdminController::class, 'verifyPayment'])->name('admin.verify');
        Route::post('/reservasis/{reservasi}/lunas', [AdminController::class, 'lunasPayment'])->name('admin.lunas');
        
        // Laporan Routes
        Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
        Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('admin.laporan.pdf');
        Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('admin.laporan.excel');
    });
});

require __DIR__.'/auth.php';

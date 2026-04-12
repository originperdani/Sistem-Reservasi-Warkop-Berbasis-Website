<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'menus' => \App\Models\Menu::take(4)->get() // Limit to 4 for Best Seller
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/menu', function () {
        return view('menu', [
            'menus' => \App\Models\Menu::all()
        ]);
    })->name('menu.index');

    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // User Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
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
    });
});

require __DIR__.'/auth.php';

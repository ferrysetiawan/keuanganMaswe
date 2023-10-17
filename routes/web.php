<?php

use App\Http\Controllers\BE\KategoriInController;
use App\Http\Controllers\BE\KategoriOutController;
use App\Http\Controllers\BE\KolamController;
use App\Http\Controllers\BE\LaporanController;
use App\Http\Controllers\BE\PembelianController;
use App\Http\Controllers\BE\PenjualanController;
use App\Http\Controllers\BE\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' =>'dashboard', 'middleware' => ['auth']],function(){
    Route::get('/', function(){
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::post('/store', [UserController::class, 'store'])->name('user-store');
        Route::get('/all', [UserController::class, 'all'])->name('user-all');
        Route::get('/edit', [UserController::class, 'edit'])->name('user-edit');
        Route::post('/update', [UserController::class, 'update'])->name('user-update');
        Route::delete('/delete', [UserController::class, 'delete'])->name('user-delete');
    });
    Route::group(['prefix' => 'master-data'], function(){
        Route::prefix('kolam')->group(function () {
            Route::get('/', [KolamController::class, 'index'])->name('kolam');
            Route::post('/store', [KolamController::class, 'store'])->name('kolam-store');
            Route::get('/all', [KolamController::class, 'all'])->name('kolam-all');
            Route::get('/edit', [KolamController::class, 'edit'])->name('kolam-edit');
            Route::post('/update', [KolamController::class, 'update'])->name('kolam-update');
            Route::delete('/delete', [KolamController::class, 'delete'])->name('kolam-delete');
        });
        Route::prefix('kategori-in')->group(function () {
            Route::get('/', [KategoriInController::class, 'index'])->name('kategori-in');
            Route::post('/store', [KategoriInController::class, 'store'])->name('kategori-in-store');
            Route::get('/all', [KategoriInController::class, 'all'])->name('kategori-in-all');
            Route::get('/edit', [KategoriInController::class, 'edit'])->name('kategori-in-edit');
            Route::post('/update', [KategoriInController::class, 'update'])->name('kategori-in-update');
            Route::delete('/delete', [KategoriInController::class, 'delete'])->name('kategori-in-delete');
        });
        Route::prefix('kategori-out')->group(function () {
            Route::get('/', [KategoriOutController::class, 'index'])->name('kategori-out');
            Route::post('/store', [KategoriOutController::class, 'store'])->name('kategori-out-store');
            Route::get('/all', [KategoriOutController::class, 'all'])->name('kategori-out-all');
            Route::get('/edit', [KategoriOutController::class, 'edit'])->name('kategori-out-edit');
            Route::post('/update', [KategoriOutController::class, 'update'])->name('kategori-out-update');
            Route::delete('/delete', [KategoriOutController::class, 'delete'])->name('kategori-out-delete');
        });
    });

    Route::prefix('penjualan')->group(function () {
        Route::get('/', [PenjualanController::class, 'index'])->name('penjualan');
        Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan-store');
        Route::get('/all', [PenjualanController::class, 'all'])->name('penjualan-all');
        Route::get('{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan-edit');
        Route::post('/update', [PenjualanController::class, 'update'])->name('penjualan-update');
        Route::delete('/delete', [PenjualanController::class, 'delete'])->name('penjualan-delete');

        Route::get('/get-categories', [PenjualanController::class, 'getCategories'])->name('get-categories');
        Route::get('/get-kolam', [PenjualanController::class, 'getKolam'])->name('get-kolam');
    });

    Route::prefix('pembelian')->group(function () {
        Route::get('/', [PembelianController::class, 'index'])->name('pembelian');
        Route::post('/store', [PembelianController::class, 'store'])->name('pembelian-store');
        Route::get('/all', [PembelianController::class, 'all'])->name('pembelian-all');
        Route::get('{id}/edit', [PembelianController::class, 'edit'])->name('pembelian-edit');
        Route::post('/update', [PembelianController::class, 'update'])->name('pembelian-update');
        Route::delete('/delete', [PembelianController::class, 'delete'])->name('pembelian-delete');

        Route::get('/get-kategori', [PembelianController::class, 'getCategories'])->name('get-kategori');
    });

    Route::prefix('laporan')->group(function(){
        Route::get('/', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/export/{daterange}', [LaporanController::class, 'export'])->name('laporan-export');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

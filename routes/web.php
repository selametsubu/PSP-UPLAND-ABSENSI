<?php

use App\Http\Controllers\AbsenDatangController;
use App\Http\Controllers\AbsenHistoriController;
use App\Http\Controllers\AbsenPulangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinCutiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\LaporanRekapKehadiranController;
use App\Http\Controllers\LaporanTimesheetBulananController;
use App\Http\Controllers\LaporanTimesheetController;
use App\Http\Controllers\PengaturanHariLiburController;
use App\Http\Controllers\PengaturanUmumController;
use App\Http\Controllers\PersonilController;
use App\Http\Controllers\ProfilSayaController;
use App\Http\Controllers\SpotKehadiranController;
use App\Http\Controllers\UbahPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/izin-cuti', [IzinCutiController::class, 'index'])->name('izin-cuti')->middleware(['auth', 'verified']);
Route::get('/izin-cuti/create', [IzinCutiController::class, 'create'])->name('izin-cuti.create')->middleware(['auth', 'verified']);
Route::get('/izin-cuti/{izin}/edit', [IzinCutiController::class, 'edit'])->name('izin-cuti.edit')->middleware(['auth', 'verified']);

Route::get('/profil-saya', [ProfilSayaController::class, 'index'])->name('profil-saya')->middleware(['auth', 'verified']);
Route::get('/ubah-password', [UbahPasswordController::class, 'index'])->name('ubah-password')->middleware(['auth', 'verified']);

Route::prefix('pengaturan')
    ->middleware(['auth', 'verified', 'permission:ADMIN'])
    ->group(function () {
        //begin:umum
        Route::get('/umum', [PengaturanUmumController::class, 'index'])->name('pengaturan.umum');
        //end:umum

        //begin:personil
        Route::get('/personil', [PersonilController::class, 'index'])->name('pengaturan.personil');
        Route::get('/personil/create', [PersonilController::class, 'create'])->name('pengaturan.personil.create');
        Route::get('/personil/{user}/edit', [PersonilController::class, 'edit'])->name('pengaturan.personil.edit');
        //end:personil

        //begin:spot
        Route::get('/spot', [SpotKehadiranController::class, 'index'])->name('pengaturan.spot');
        Route::get('/spot/create', [SpotKehadiranController::class, 'create'])->name('pengaturan.spot.create');
        Route::get('/spot/{spot}/edit', [SpotKehadiranController::class, 'edit'])->name('pengaturan.spot.edit');
        //end:spot

        //begin:umum
        Route::get('/hari-libur', [PengaturanHariLiburController::class, 'index'])->name('pengaturan.hari-libur');
        //end:umum
    });

Route::prefix('kehadiran')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        //begin:absen-datang
        Route::get('/absen-datang', [AbsenDatangController::class, 'index'])->name('kehadiran.absen-datang');
        Route::get('/absen-datang/sukses', [AbsenDatangController::class, 'success'])->name('kehadiran.absen-datang.success');
        Route::get('/absen-datang/gagal', [AbsenDatangController::class, 'error'])->name('kehadiran.absen-datang.error');
        //end:absen-datang

        //begin:absen-datang
        Route::get('/absen-pulang', [AbsenPulangController::class, 'index'])->name('kehadiran.absen-pulang');
        Route::get('/absen-pulang/sukses', [AbsenPulangController::class, 'success'])->name('kehadiran.absen-pulang.success');
        Route::get('/absen-pulang/gagal', [AbsenPulangController::class, 'error'])->name('kehadiran.absen-pulang.error');
        //end:absen-datang

        //begin:absen-histori
        Route::get('/absen-histori', [AbsenHistoriController::class, 'index'])->name('kehadiran.absen-histori');
        //end:absen-histori

    });

    Route::prefix('laporan')
        ->middleware(['auth', 'verified'])
        ->group(function () {
            //begin:absen-datang
            Route::get('/rekap-kehadiran', [LaporanRekapKehadiranController::class, 'index'])->name('laporan.rekap-kehadiran');
            Route::get('/rekap-kehadiran/export', [LaporanRekapKehadiranController::class, 'export'])->name('laporan.rekap-kehadiran.export');
            Route::get('/timesheet-bulanan', [LaporanTimesheetBulananController::class, 'index'])->name('laporan.timesheet-bulanan');
            Route::get('/timesheet-bulanan/export', [LaporanTimesheetBulananController::class, 'export'])->name('laporan.timesheet-bulanan.export');
            Route::get('/timesheet', [LaporanTimesheetController::class, 'index'])->name('laporan.timesheet');
            Route::get('/timesheet/export', [LaporanTimesheetController::class, 'export'])->name('laporan.timesheet.export');
        });


Route::get('/download_file', function () {
    if (Storage::exists('public/' . request('path'))) {
        return redirect(asset('storage') . '/' . request('path'));
    } else {
        return 'file not found';
    }
})->name('download_file');

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\Api\AbsenHadirController;
use App\Http\Controllers\Api\AbsenHariLiburController;
use App\Http\Controllers\Api\AbsenIzinController;
use App\Http\Controllers\Api\AbsenSpotController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\MsWilDesaController;
use App\Http\Controllers\Api\MsWilKabController;
use App\Http\Controllers\Api\MsWilKecController;
use App\Http\Controllers\Api\SysGlobalVarApiController;
use App\Http\Controllers\Api\SysRoleController;
use App\Http\Controllers\Api\SysUserController;
use App\Http\Controllers\Api\SysZonaWaktuController;
use App\Models\AbsenHadir;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// sysglobalvar
Route::get('/globalvar/dt', [SysGlobalVarApiController::class, 'dt']);
Route::apiResource('/globalvar', SysGlobalVarApiController::class);

// sysuser
Route::get('/user/dt', [SysUserController::class, 'dt']);
Route::put('/user/{user}/update-profil', [SysUserController::class, 'updateProfile']);
Route::put('/user/{user}/update-password', [SysUserController::class, 'updatePassword']);
Route::apiResource('/user', SysUserController::class);

// sysrole
Route::get('/role/select2', [SysRoleController::class, 'select2']);
Route::apiResource('/role', SysRoleController::class);

// syszonawaktu
Route::get('/zona-waktu', [SysZonaWaktuController::class, 'index']);

// kab
Route::get('/kab/select2', [MsWilKabController::class, 'select2']);
Route::apiResource('/kab', MsWilKabController::class);

// kec
Route::get('/kec/select2', [MsWilKecController::class, 'select2']);
Route::apiResource('/kec', MsWilKecController::class);

// desa
Route::get('/desa/select2', [MsWilDesaController::class, 'select2']);
Route::apiResource('/desa', MsWilDesaController::class);

// spot
Route::get('/spot/dt', [AbsenSpotController::class, 'dt']);
Route::get('/spot/select2', [AbsenSpotController::class, 'select2']);
Route::apiResource('/spot', AbsenSpotController::class);

// absen-hadir
Route::get('/absen-hadir/dt', [AbsenHadirController::class, 'dt']);
Route::get('/absen-hadir/sudah-absen', [AbsenHadirController::class, 'checkAlreadyAbsen']);
Route::apiResource('/absen-hadir', AbsenHadirController::class);

// laporan
Route::get('/laporan/tahun', [LaporanController::class, 'tahun']);
Route::get('/laporan/rekap-kehadiran', [LaporanController::class, 'rekapKehadiran']);
Route::get('/laporan/timesheet-bulanan', [LaporanController::class, 'timesheetBulanan']);
Route::get('/laporan/timesheet', [LaporanController::class, 'timesheet']);
Route::get('/laporan/dashboard-all', [LaporanController::class, 'dashboardAll']);
Route::get('/laporan/dashboard-user', [LaporanController::class, 'dashboardUser']);

// libur
Route::get('/libur/dt', [AbsenHariLiburController::class, 'dt']);
Route::apiResource('/libur', AbsenHariLiburController::class);

// izin
Route::get('/izin/check', [AbsenIzinController::class, 'checkIzinCuti']);
Route::get('/izin/dt', [AbsenIzinController::class, 'dt']);
Route::get('/izin/ref-jenis', [AbsenIzinController::class, 'refJenisIzin']);
Route::post('/izin/upload-dok', [AbsenIzinController::class, 'uploadDokumen']);
Route::delete('/izin/{izin}/destroy-dok', [AbsenIzinController::class, 'destroyDok']);
Route::apiResource('/izin', AbsenIzinController::class);

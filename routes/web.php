<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\SplitDataController;
use App\Http\Controllers\Admin\DeleteDataController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\ModelController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::post('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.store');
Route::get('/konsultasi/riwayat', [KonsultasiController::class, 'riwayat'])->name('konsultasi.riwayat');
Route::delete('/konsultasi/riwayat/{id}', [KonsultasiController::class, 'hapusSatuan'])->name('konsultasi.hapus_satuan');
Route::delete('/konsultasi/riwayat', [KonsultasiController::class, 'hapusSemua'])->name('konsultasi.hapus_riwayat');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/hapus/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import', [ImportController::class, 'store'])->name('import.store');

    Route::get('/split', [SplitDataController::class, 'index'])->name('split.index');
    Route::post('/split', [SplitDataController::class, 'store'])->name('split.store');

    Route::get('/train', [TrainingController::class, 'index'])->name('train.index');
    Route::post('/train', [TrainingController::class, 'store'])->name('train.store');

    Route::get('/evaluate', [EvaluationController::class, 'index'])->name('evaluation.index');

    Route::get('/delete', [DeleteDataController::class, 'index'])->name('delete.index');
    Route::post('/delete', [DeleteDataController::class, 'store'])->name('delete.store');

    // Parameter Model
    Route::get('/model', [ModelController::class, 'index'])->name('model.index');

    // Master Penyakit CRUD
    Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit.index');
    Route::post('/penyakit', [PenyakitController::class, 'store'])->name('penyakit.store');
    Route::put('/penyakit/{id}', [PenyakitController::class, 'update'])->name('penyakit.update');
    Route::delete('/penyakit/{id}', [PenyakitController::class, 'destroy'])->name('penyakit.destroy');
});

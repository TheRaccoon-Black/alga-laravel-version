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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::post('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.store');

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
});

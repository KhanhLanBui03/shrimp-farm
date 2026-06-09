<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FarmingZoneController;
use App\Http\Controllers\PondController;
use App\Http\Controllers\CultivationCycleController;
use App\Http\Controllers\SeedBatchController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TechnicalLogController;
use App\Http\Controllers\WaterQualityLogController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SalesInvoiceController;
use App\Http\Controllers\OperatingExpenseController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Business Modules Resource Routes
    Route::resource('farming-zones', FarmingZoneController::class);
    Route::resource('ponds', PondController::class);
    Route::resource('cultivation-cycles', CultivationCycleController::class);
    Route::resource('seed-batches', SeedBatchController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('technical-logs', TechnicalLogController::class);
    Route::resource('water-quality-logs', WaterQualityLogController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('sales-invoices', SalesInvoiceController::class);
    Route::resource('operating-expenses', OperatingExpenseController::class);
    Route::resource('harvests', HarvestController::class);
    Route::resource('customers', CustomerController::class);

    // Systems Management & Audit logs
    Route::get('/users', function () {
        return view('users.index');
    })->name('users.index');
    Route::get('/audit-logs', function () {
        return 'Nhật ký hoạt động';
    })->name('audit-logs.index');
});

require __DIR__.'/auth.php';

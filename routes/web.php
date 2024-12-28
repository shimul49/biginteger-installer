<?php

use Illuminate\Support\Facades\Route;
use BigInteger\LaravelInstaller\Http\Controllers\InstallerController;

Route::group(['prefix' => 'install', 'middleware' => ['web']], function () {
    Route::get('requirements', [InstallerController::class, 'requirements'])->name('installer.requirements');
    Route::get('permissions', [InstallerController::class, 'permissions'])->name('installer.permissions');
    Route::get('purchase', [InstallerController::class, 'purchase'])->name('installer.purchase');
    Route::post('purchase/verify', [InstallerController::class, 'verifyPurchase'])->name('installer.purchase.verify');
    Route::get('database', [InstallerController::class, 'database'])->name('installer.database');
    Route::post('database/setup', [InstallerController::class, 'setupDatabase'])->name('installer.database.setup');
    Route::get('application', [InstallerController::class, 'application'])->name('installer.application');
    Route::post('finalize', [InstallerController::class, 'finalize'])->name('installer.finalize');
}); 
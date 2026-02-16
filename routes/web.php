<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LicenseController;

Route::get('/license/activate', [LicenseController::class, 'show'])->name('license.show');
Route::post('/license/activate', [LicenseController::class, 'activate'])->name('license.activate');
Route::get('/license/status', [LicenseController::class, 'status'])->name('license.status');

Route::get('/', function () {
    return redirect('/admin');
});

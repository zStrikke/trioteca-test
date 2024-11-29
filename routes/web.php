<?php

use App\Http\Controllers\DwellingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/dwelling', [DwellingController::class, 'store'])->name('dwelling.store');
Route::patch('/dwelling/u/status/{dwelling}', [DwellingController::class, 'updateStatus'])->name('dwelling.updateStatus');

Route::get('/dwelling/{dwelling}', [DwellingController::class, 'show'])->name('dwelling.show');

Route::get('/dwellings', [DwellingController::class, 'index'])->name('dwelling.index');

Route::get('/dwelling/{dwelling}/logs', [DwellingController::class, 'logs'])->name('dwelling.show.logs');
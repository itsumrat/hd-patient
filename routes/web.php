<?php

use App\Http\Controllers\ArchivController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BesucheController;
use App\Http\Controllers\PhoneticketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth:patient')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/agb', [HomeController::class, 'agb']);
    Route::get('/profile', [LoginController::class, 'profile']);
    Route::get('/besuche', [BesucheController::class, 'index']);
    Route::post('/phoneTicket', [PhoneticketController::class, 'store']);
    Route::get('/archiv', [ArchivController::class, 'index']);
    Route::get('/agree', [ArchivController::class, 'agree']);

});



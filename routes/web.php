<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GameHistoryController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\TemporaryRegistrationController;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;

Route::get('/register', [TemporaryRegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [TemporaryRegistrationController::class, 'register'])->name('register.submit');
Route::middleware([CheckToken::class])->group(function () {
    Route::get('/access/{token}', [LinkController::class, 'accessPage'])->name('access.page');
    Route::get('/generate-new-link/{token}', [LinkController::class, 'generateNewLink'])->name('link.generate');
    Route::post('/deactivate/{token}', [LinkController::class, 'deactivateLink'])->name('link.deactivate');
    Route::get('/history/{token}', [GameHistoryController::class, 'showHistory'])->name('game.history');
    Route::post('/play/{token}', [GameController::class, 'playLuckyGame'])->name('game.play');
});
Route::get('/', function () {
    return view('welcome');
});


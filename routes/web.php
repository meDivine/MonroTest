<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/settings/update', [UserSettingController::class, 'showUpdateForm'])->name('settings.update-form');
    Route::post('/settings/update', [UserSettingController::class, 'update'])->name('settings.update');
    Route::get('/settings/confirm', [UserSettingController::class, 'showConfirmForm'])->name('settings.confirm-form');
    Route::post('/settings/confirm', [UserSettingController::class, 'confirm'])->name('settings.confirm');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

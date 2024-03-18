<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [\App\Http\Controllers\Seeker\DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [\App\Http\Controllers\Seeker\ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [\App\Http\Controllers\Seeker\ProfileController::class, 'update'])->name('profile.update');

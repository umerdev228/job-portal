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
Route::put('/profile/password', [\App\Http\Controllers\Seeker\ProfileController::class, 'updatePassword'])->name('profile.password.update');
Route::put('/profile/address', [\App\Http\Controllers\Seeker\ProfileController::class, 'updateAddress'])->name('profile.address.update');
Route::put('/profile/qualification', [\App\Http\Controllers\Seeker\ProfileController::class, 'updateQualification'])->name('profile.qualification.update');

Route::resource('job/applied',\App\Http\Controllers\Seeker\JobApplyController::class);

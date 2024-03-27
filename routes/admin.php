<?php

use App\Http\Controllers\Controller;
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


Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
Route::resource('skills', \App\Http\Controllers\Admin\SkillController::class);
Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('universities',\App\Http\Controllers\Admin\UniversityController::class);
Route::resource('degrees',\App\Http\Controllers\Admin\DegreeController::class);
Route::resource('countries',\App\Http\Controllers\Admin\CountryController::class);
Route::resource('cities',\App\Http\Controllers\Admin\CityController::class);

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

// Route::get('/send-mail', [\App\Http\Controllers\EmailController::class, 'index']);



Route::put('/admin/jobs/updateFeature/{id}', [\App\Http\Controllers\Admin\JobController::class, 'updateFeature'])->name('admin.jobs.updateFeature');
Route::put('/admin/skills/updateStatus/{id}', [\App\Http\Controllers\Admin\SkillController::class, 'updateStatus'])->name('admin.skills.updateStatus');
Route::put('/admin/categories/updateCategories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'updateCategories'])->name('admin.categories.updateCategories');
Route::put('/admin/categories/updateFeature/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'updateFeature'])->name('admin.categories.updateFeature');
Route::put('/admin/degrees/updatedegrees/{id}', [\App\Http\Controllers\Admin\DegreeController::class, 'updateDegree'])->name('admin.degrees.updatedegrees');
Route::put('/admin/degrees/updateCountries/{id}', [\App\Http\Controllers\Admin\CountryController::class, 'updateCountry'])->name('admin.countries.updateCountries');
Route::put('/admin/cities/updateCities/{id}', [\App\Http\Controllers\Admin\CityController::class, 'updateCity'])->name('admin.cities.updateCities');

Route::any('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::any('/jobs', [\App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [\App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/apply/{job}', [\App\Http\Controllers\JobController::class, 'apply'])->name('jobs.apply');

Route::get('/talents', [\App\Http\Controllers\SeekerProfileController::class, 'index'])->name('talents.index');
Route::get('/talents/{user}', [\App\Http\Controllers\SeekerProfileController::class, 'show'])->name('talents.show');
Route::get('/about',[App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
Route::get('/term',[\App\Http\Controllers\TermController::class, 'index'])->name('term.index');

Route::middleware('auth')->group(function () {
    Route::post('/job/apply/{job}',[\App\Http\Controllers\JobController::class, 'apply'])->name('job.apply');
});


//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('countries/cities', function () {
    $response = Http::get('https://countriesnow.space/api/v0.1/countries');

    foreach ($response->json()['data'] as $res) {
        $country = \App\Models\Country::where('title', $res['country'])->first();
        if ($country) {
            foreach ($res['cities'] as $city) {
                \App\Models\City::create([
                    'title' => $city,
                    'country_id' => $country->id,
                ]);

            }
        }
        else {
            $country = \App\Models\Country::create([
               'title' => $res['country'],
               'iso2' => $res['iso2'],
               'iso3' => $res['iso3'],
            ]);
            foreach ($res['cities'] as $city) {
                \App\Models\City::create([
                    'title' => $city,
                    'country_id' => $country->id,
                ]);

            }
        }
    }
    dd($response->json()['data']);
});

require __DIR__.'/auth.php';

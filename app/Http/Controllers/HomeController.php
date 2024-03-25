<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', Category::STATUS_ACTIVE)->limit(4)->get();
          // Fetch latest 8 jobs
         $jobs = Job::latest()->take(8)->get();  
          
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'categories' => $categories,
              'jobs' => $jobs,
             
             
        ]);
    }
}
